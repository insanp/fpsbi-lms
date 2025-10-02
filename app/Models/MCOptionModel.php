<?php
namespace App\Models;

use CodeIgniter\Model;

class MCOptionModel extends Model
{
    protected $table = 'mc_options';
    protected $primaryKey = 'id';

    protected $allowedFields = ['question_id', 'option_text', 'is_correct'];

    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'question_id' => 'required',
        'option_text' => 'required|min_length[3]',
        'is_correct' => 'required',
    ];

    protected $validationMessages = [
        'question_id' => [
            'required' => 'The question id field is required.',
        ],
        'option_text' => [
            'required' => 'The option text field is required.',
            'min_length' => 'The option text must be at least 3 characters long.',
        ],
        'is_correct' => [
            'required' => 'The correct flag field is required.',
        ]
    ];

    protected $beforeInsert = [];
}
