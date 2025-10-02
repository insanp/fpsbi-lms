<?php
namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';

    protected $allowedFields = ['author_id', 'title', 'slug', 'resume', 'content', 'status', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'title' => 'required|min_length[3]|max_length[100]',
        'slug' => 'required|is_unique[articles.slug,id,{id}]',
        'resume' => 'required|min_length[10]|max_length[255]',
        'content' => 'required|min_length[50]|max_length[50000]',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'The title field is required.',
            'min_length' => 'The title must be at least 3 characters long.',
            'max_length' => 'The title cannot exceed 100 characters.',
        ],
        'slug' => [
            'is_unique' => 'The slug is not unique, identical title existed. Try modifying title.',
        ],
        'resume' => [
            'required' => 'The resume field is required.',
            'min_length' => 'The resume must be at least 10 characters long.',
            'max_length' => 'The resume cannot exceed 255 characters.',
        ],
        'content' => [
            'required' => 'The content field is required.',
            'min_length' => 'The content must be at least 50 characters long.',
            'max_length' => 'The content cannot exceed 50000 characters.',
        ],
    ];

    protected $beforeInsert = [];
}
