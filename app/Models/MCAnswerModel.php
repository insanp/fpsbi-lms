<?php

namespace App\Models;

use CodeIgniter\Model;

class MCAnswerModel extends Model
{
    protected $table = 'mc_answers';
    protected $primaryKey = 'id';

    protected $allowedFields = ['question_id', 'selected_option_id', 'task_attempt_id', 'answered_at'];

    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'selected_option_id' => 'required',
        'task_attempt_id' => 'required'
    ];

    protected $beforeInsert = [];

    public function insertBatchUpdateOnDuplicate(array $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table); // Assumes $this->table is set to 'mc_answers'

        $sql = 'INSERT INTO ' . $this->table . ' (question_id, selected_option_id, task_attempt_id, answered_at) VALUES ';

        $values = array_map(function ($row) use ($db) {
            return '(' .
                $db->escape($row['question_id']) . ', ' .
                $db->escape($row['selected_option_id']) . ', ' .
                $db->escape($row['task_attempt_id']) . ', ' .
                $db->escape($row['answered_at']) .
                ')';
        }, $data);

        $sql .= implode(', ', $values);
        $sql .= ' ON DUPLICATE KEY UPDATE selected_option_id = VALUES(selected_option_id), answered_at = VALUES(answered_at)';

        return $db->query($sql);
    }

    public function getAnswersByTaskAttemptId($taskAttemptId)
    {
        $results = $this->where('task_attempt_id', $taskAttemptId)->findAll();

        // Organize results by question_id for easy lookup
        $answers = [];
        foreach ($results as $result) {
            $answers[$result['question_id']] = $result['selected_option_id'];
        }

        return $answers;
    }
}
