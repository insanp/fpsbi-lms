<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['member_id', 'email', 'password', 'name', 'is_active', 'is_admin', 'is_fresh_acc', 'created_at', 'updated_at', 'last_login'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowCallbacks = true;

    // Validation rules for user registration
    protected $validationRules = [
        'id' => 'permit_empty',
        'member_id' => 'required|is_unique[users.member_id,id,{id}]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'permit_empty|min_length[8]',
        'password_confirm' => 'matches[password]',
        'name' => 'required|min_length[3]',
    ];

    protected $loginValidationRules = [
        'email' => 'required|valid_email',
        'password' => 'required|min_length[8]',
    ];

    // Validation custom error messages
    protected $validationMessages = [
        'member_id' => [
            'is_unique' => 'The member id is already in use.',
        ],
        'email' => [
            'is_unique' => 'The email address is already in use.',
        ],
    ];

    // Hash the password before inserting and updating into the database
    protected $beforeInsert = ['hashPassword', 'sanitizeData'];
    protected $beforeUpdate = ['hashPassword', 'sanitizeData'];

    protected function hashPassword(array $data)
    {
        log_message('debug', 'hashPassword callback triggered.');
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }

    protected function sanitizeData(array $data)
    {
        if (isset($data['data']['name'])) {
            $data['data']['name'] = strip_tags($data['data']['name']);
        }
        if (isset($data['data']['email'])) {
            $data['data']['email'] = strip_tags($data['data']['email']);
        }

        return $data;
    }


    public function validateLogin($email, $password)
    {
        $validation = \Config\Services::validation();

        // Set validation rules for login
        $validation->setRules($this->loginValidationRules);

        // Validate input data
        if (!$validation->run(['email' => $email, 'password' => $password])) {
            return ['error' => $validation->getErrors()];
        }

        // Find user by email
        $user = $this->where('email', $email)->first();

        if (!$user) {
            return ['error' => ['email' => 'User not found']];
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return ['error' => ['password' => 'Incorrect password']];
        }

        // Update last login without updating updated_at, should be safe due to ?
        $this->db->query("UPDATE users SET last_login = ? WHERE id = ?", [date('Y-m-d H:i:s'), $user['id']]);

        // Update the user object to reflect the last login time
        $user['last_login'] = date('Y-m-d H:i:s');

        // Login successful
        return ['user' => $user];
    }

    public function searchUsers($searchTerm)
    {
        return $this->like('name', $searchTerm)
            ->orLike('email', $searchTerm)
            ->orLike('member_id', $searchTerm);
    }

    public function generateMemberId()
    {
        // Get the current year and month
        $year = date('y'); // 'yy' format (e.g., '24')
        $month = date('m'); // 'MM' format (e.g., '11')
        $prefix = 'F' . $year . $month;

        // Query the database for the latest member_id with the same prefix
        $latestMember = $this->select('member_id')
            ->like('member_id', $prefix, 'after') // Fetch IDs starting with the prefix
            ->orderBy('member_id', 'DESC') // Get the latest ID
            ->first();

        // Determine the next incremental ID
        if ($latestMember) {
            // Extract the numeric part and increment it
            $lastIncrement = intval(substr($latestMember['member_id'], -3));
            $newIncrement = str_pad($lastIncrement + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // No IDs found for the current prefix, start with '001'
            $newIncrement = '001';
        }

        // Combine prefix and new increment to form the new member_id
        return $prefix . $newIncrement;
    }
}
