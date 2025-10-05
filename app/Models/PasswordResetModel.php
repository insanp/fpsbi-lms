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
}
