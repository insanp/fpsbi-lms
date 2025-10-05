<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table      = 'password_resets';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'token',
        'expires_at',
        'created_at'
    ];

    protected $useTimestamps = false; // Set to true if you want CodeIgniter to manage created_at/updated_at

    protected $validationRules = [
        'user_id'    => 'required|integer',
        'token'      => 'required|string',
        'expires_at' => 'required|valid_date',
    ];

    /**
     * Create a new password/account reset request for a user.
     * Inserts the token into the DB and returns token and expires.
     * @param int $userId
     * @param int $expireMinutes
     * @return array ['token' => string, 'expires' => string]
     */
    public static function createNewRequest($userId, $expireMinutes = 4320) // 4320 = 3 days
    {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+' . $expireMinutes . ' minutes'));
        $model = new self();
        $model->insert([
            'user_id' => $userId,
            'token' => $token,
            'expires_at' => $expires,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return [
            'token' => $token,
            'expires' => $expires
        ];
    }
}
