<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = ['topic_id', 'name', 'starting_statement', 'finishing_statement', 'type', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'name' => 'required|min_length[3]|max_length[255]',
        'starting_statement' => 'required|min_length[10]|max_length[500]',
        'finishing_statement' => 'required|min_length[10]|max_length[500]',
        'type' => 'required|in_list[quiz,assignment,exam,exam_mc,exam_short_answers]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'The title field is required.',
            'min_length' => 'The title must be at least 3 characters long.',
            'max_length' => 'The title cannot exceed 500 characters.',
        ],
        'starting_statement' => [
            'required' => 'The starting statement field is required.',
            'min_length' => 'The starting statement must be at least 10 characters long.',
            'max_length' => 'The starting statement cannot exceed 500 characters.',
        ],
        'finishing_statement' => [
            'required' => 'The finishing statement field is required.',
            'min_length' => 'The finishing statement must be at least 10 characters long.',
        ],
        'type' => [
            'required' => 'The type field is required.',
            'in_list' => 'The type must be one of: quiz, assignment, exam, exam_mc, exam_short_answers.',
        ]
    ];

    protected $beforeInsert = [];

    public function getTaskIdByCourse($courseId, $type = null)
    {
        // Join the topics table to find the relevant topic_id
        $query = $this->select('tasks.id AS id, tasks.type as type')
            ->join('topics', 'topics.id = tasks.topic_id')
            ->join('course_topics', 'course_topics.topic_id = topics.id')
            ->where('course_topics.course_id', $courseId);

        if (!is_null($type)) {
            $query->where('tasks.type', $type);
        }

        return $query->findAll();
    }

    public function getExamMcTaskWithQuestionsByCourse($courseId)
    {
        // Get the task_id for the exam_mc type
        $data = $this->getTaskIdByCourse($courseId, 'exam_mc');
        $taskIdData = $data[0]; // assume only one

        if ($taskIdData) {
            $taskId = $taskIdData['id'];

            // Load questions and options using TaskAndQuestionModel
            $taskAndQuestionModel = new \App\Models\TaskAndQuestionModel();
            return $taskAndQuestionModel->loadTaskAndQuestions($taskId);
        }

        return null; // Return null if no exam_mc task is found
    }
}
