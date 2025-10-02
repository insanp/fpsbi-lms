<?php
namespace App\Models;

use CodeIgniter\Model;

class ClientFormLinksModel extends Model
{
    protected $table = 'client_form_links';
    protected $primaryKey = 'id';

    protected $allowedFields = ['inviter_id', 'client_name', 'form_type', 'expiration_date', 'used', 'created_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'inviter_id' => 'required',
        'client_name' => 'required|min_length[10]|max_length[100]',
        'form_type' => 'required'
    ];

    protected $beforeInsert = [];
}
