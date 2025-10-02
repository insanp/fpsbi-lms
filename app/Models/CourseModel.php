<?php
namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'image_url', 'description', 'created_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'name' => 'required|min_length[3]|max_length[100]',
        'description' => 'required|min_length[3]|max_length[100]',
    ];

    protected $beforeInsert = [];
}
