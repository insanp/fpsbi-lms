<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TaskModel;
use App\Models\TaskAttemptsModel;

class ProgressModel extends Model
{
    protected $table = 'progress';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'topic_id', 'completed_at'];

    public function checkAndInsertProgress($userId, $topicId, $skipNoTask = false)
    {
        $taskModel = new TaskModel();
        $taskAttemptModel = new TaskAttemptModel();

        // Get all tasks for the specified topic
        $tasks = $taskModel->where('topic_id', $topicId)->findAll();

        // If no tasks found and flag is enabled, skip inserting progress.
        if ($skipNoTask && empty($tasks)) {
            return false;
        }

        $latestCompletedAt = null;
        $taskModel = new TaskModel();
        foreach ($tasks as $task) {
            if ($task['type'] === 'exam_mc') {
                // Only consider attempts with score >= 80 and completed_at not null for exam_mc
                $attempt = $taskAttemptModel->where([
                    'task_id' => $task['id'],
                    'user_id' => $userId
                ])->where('score >=', 80)->where('completed_at IS NOT NULL')->orderBy('completed_at', 'DESC')->first();
                if (!$attempt) {
                    return false; // Early exit if no passing attempt
                }
                if (!empty($attempt['completed_at'])) {
                    $latestCompletedAt = $attempt['completed_at'];
                }
            } else {
                // For other types, use original completion logic
                if (!$taskAttemptModel->isTaskCompleted($task['id'], $userId)) {
                    return false;
                }
                $attempt = $taskAttemptModel->where([
                    'task_id' => $task['id'],
                    'user_id' => $userId
                ])->orderBy('completed_at', 'DESC')->first();
                if ($attempt && !empty($attempt['completed_at'])) {
                    $latestCompletedAt = $attempt['completed_at'];
                }
            }
        }
        $this->insertProgress($userId, $topicId, $latestCompletedAt);
        return true;
    }

    public function insertProgress($userId, $topicId, $completedAt = null)
    {
        // Default to current timestamp if not provided
        if (is_null($completedAt)) {
            $completedAt = date('Y-m-d H:i:s');
        }

        // Check if a record exists for this user and topic
        $existingProgress = $this->where([
            'user_id'  => $userId,
            'topic_id' => $topicId
        ])->first();

        if ($existingProgress) {
            if (is_null($existingProgress['completed_at'])) {
                return $this->update($existingProgress['id'], [
                    'completed_at' => $completedAt
                ]);
            }
            return false;
        }

        return $this->insert([
            'user_id'      => $userId,
            'topic_id'     => $topicId,
            'completed_at' => $completedAt
        ]);
    }
}
