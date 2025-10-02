<?php
namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';

    protected $allowedFields = ['question', 'image', 'question_type', 'correct_feedback', 'incorrect_feedback', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'question' => 'required',
        'image' => 'permit_empty'
    ];

    protected $validationMessages = [
        'question' => [
            'required' => 'The question field is required.'
        ]
    ];

    protected $beforeInsert = [];
}
