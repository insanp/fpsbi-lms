<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseExamModel extends Model
{
    protected $table = 'courses_exams';
    protected $primaryKey = 'id';

    protected $allowedFields = ['course_id', 'topic_id'];
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'course_id' => 'required',
        'topic_id' => 'required'
    ];

    protected $beforeInsert = [];

    public function isExamTopicCompleted($courseId)
    {
        $db = \Config\Database::connect();

        // Step 1: Find the exam topic ID for the given course
        $builder = $db->table($this->table);
        $examTopic = $builder->select('topic_id')
            ->where('course_id', $courseId)
            ->get()
            ->getRowArray();

        if (!$examTopic) {
            return false; // No exam topic found for the course
        }

        $topicId = $examTopic['topic_id'];

        // Step 2: Find all exam-related tasks in this topic
        $taskBuilder = $db->table('tasks');
        $tasks = $taskBuilder->select('id')
            ->where('topic_id', $topicId)
            ->whereIn('type', ['exam', 'exam_mc', 'exam_short_answers'])
            ->get()
            ->getResultArray();

        if (empty($tasks)) {
            return false; // No exam tasks found in the topic
        }

        // Step 3: Check task_attempts for completion
        $taskIds = array_column($tasks, 'id');

        $attemptBuilder = $db->table('task_attempts');
        $incompleteAttempts = $attemptBuilder->whereIn('task_id', $taskIds)
            ->where('completed_at IS NULL')
            ->countAllResults();

        return $incompleteAttempts === 0; // True if all attempts are completed, false if any are incomplete
    }
}
