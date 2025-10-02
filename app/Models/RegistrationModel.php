<?php
namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{
    protected $table = 'registrations';
    protected $primaryKey = 'email';

    protected $allowedFields = ['nama_lengkap', 'gender', 'tanggal_lahir', 'no_ktp', 'kota_domisili', 'email', 'no_hp', 'social_media', 'no_cfp_rfp', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowCallbacks = true;

    // Validation rules for user registration
    protected $validationRules = [
        'id' => 'permit_empty',
        'nama_lengkap' => 'required|max_length[100]',
        'gender' => 'required|max_length[10]',
        'tanggal_lahir' => 'required|max_length[10]',
        'no_ktp' => 'required|max_length[16]',
        'kota_domisili' => 'required|max_length[50]',
        'email' => 'required|valid_email|max_length[50]',
        'no_hp' => 'required|max_length[50]',
        'social_media' => 'max_length[100]',
        'no_cfp_rfp' => 'max_length[50]',
    ];

    // Validation custom error messages
    protected $validationMessages = [
    ];

}
