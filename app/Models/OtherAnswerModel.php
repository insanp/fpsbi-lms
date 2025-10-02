<?php

namespace App\Models;

use CodeIgniter\Model;

class OtherAnswerModel extends Model
{
    protected $table = 'other_answers';
    protected $primaryKey = 'id';

    protected $allowedFields = ['task_attempt_id', 'answer', 'feedback', 'answered_at'];

    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'task_attempt_id' => 'required',
        'answer' => 'required'
    ];

    protected $beforeInsert = [];

    public function insertUpdateOnDuplicate(array $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $sql = "
    INSERT INTO `other_answers` (`task_attempt_id`, `answer`, `answered_at`)
    VALUES (:task_attempt_id:, :answer:, :answered_at:)
    ON DUPLICATE KEY UPDATE
        `answer` = VALUES(`answer`),
        `feedback` = NULL, -- Set feedback to NULL if you don’t have a value, or use VALUES(feedback) if it's in the params
        `answered_at` = VALUES(`answered_at`)
";

        // Prepare the parameters without escaping
        $params = [
            'task_attempt_id' => $data['task_attempt_id'],
            'answer' => $data['answer'],
            'answered_at' => date('Y-m-d H:i:s')
        ];

        // Execute the query with parameters
        return $db->query($sql, $params);
    }
}
