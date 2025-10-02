<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskAttemptModel extends Model
{
    protected $table = 'task_attempts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'task_id', 'score', 'created_at', 'completed_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = ''; // not used

    public function isTaskCompleted($taskId, $userId)
    {
        return $this->where([
            'task_id' => $taskId,
            'user_id' => $userId,
            'completed_at !=' => null // assuming 'completed_at' is not null for completed tasks
        ])->countAllResults() > 0;
    }

    public function insertIfNotExists($userId, $taskId, $data)
    {
        // Check if a record already exists for the given user and task
        $existingAttempt = $this->where([
            'user_id' => $userId,
            'task_id' => $taskId
        ])->first();

        // If no existing attempt, insert a new record
        if (!$existingAttempt) {
            return $this->insert($data);
        }

        // If it exists, return false or any other indicator that insertion was skipped
        return false;
    }

    public function markAsCompleted($userId, $taskId, $score = 100)
    {
        // Find the task attempt record for the user and task
        $taskAttempt = $this->where([
            'user_id' => $userId,
            'task_id' => $taskId
        ])->first();

        // If a task attempt exists, mark it as completed
        if ($taskAttempt) {
            $this->where('id', $taskAttempt['id'])->set([
                'completed_at' => date('Y-m-d H:i:s'),
                'score' => $score
            ])->update();

            // Return the task_attempt_id after marking as completed
            return $taskAttempt['id'];
        }

        // Return false or null if no task attempt was found
        return false;
    }

    public function markAsCompletedByAttemptId($id, $score = 100)
    {
            $this->where('id', $id)->set([
                'completed_at' => date('Y-m-d H:i:s'),
                'score' => $score
            ])->update();
    }

    public function hasAttemptsForCourseExam($userId, $courseId)
    {
        // Load models
        $courseExamsModel = new \App\Models\CourseExamModel();
        $taskModel = new \App\Models\TaskModel();

        // Step 1: Retrieve all topic IDs associated with the given course in `courses_exams`
        $topicIds = $courseExamsModel->where('course_id', $courseId)->findColumn('topic_id');

        if (empty($topicIds)) {
            return false; // No topics found for this course, so no exam attempts can exist
        }

        // Step 2: Retrieve all task IDs associated with these topics in `tasks`
        $taskIds = $taskModel->whereIn('topic_id', $topicIds)->findColumn('id');

        if (empty($taskIds)) {
            return false; // No tasks found for these topics, so no attempts can exist
        }

        // Step 3: Check for any task attempts for these task IDs and the specified user
        return $this->where('user_id', $userId)
            ->whereIn('task_id', $taskIds)
            ->countAllResults() > 0;
    }
}
