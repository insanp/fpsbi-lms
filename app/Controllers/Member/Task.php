<?php

namespace App\Controllers\Member;

use App\Models\UserModel;
use App\Models\TaskModel;
use App\Models\QuestionModel;
use App\Models\TaskAndQuestionModel;
use App\Models\TaskAttemptModel;
use App\Models\ProgressModel;
use App\Models\MCOptionModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Exceptions\HTTPException;

class Task extends \App\Controllers\BaseController
{
    private $cache;
    private $session;
    private $sessionData;

    public function __construct()
    {
        $this->cache = \Config\Services::cache();

        // Ensure the session library is loaded
        $this->session = session();

        // Load the UserModel or any other necessary models
        $this->sessionData = $this->session->get('user');
    }


    public function loadQuiz($taskId)
    {
        $taskAndQuestionsModel = new TaskAndQuestionModel();
        return json_encode($taskAndQuestionsModel->loadTaskAndQuestions($taskId));
    }

    public function submitMCAnswer()
    {
        $postData = file_get_contents('php://input');
        $data = json_decode($postData, true);

        // check answer to database
        $mcoModel = new MCOptionModel();
        $mcOptions = $mcoModel->where('question_id', $data['question_id'])->findAll();
        $correctOptionId = null;
        $correct = false;

        foreach ($mcOptions as $mcOption) {
            if ($mcOption['is_correct']) {
                $correctOptionId = $mcOption['id'];
            }
        }

        $correct = ($correctOptionId == $data['option_id']) ? true : false;

        $response = array(
            'is_correct' => $correct,
            'correct_option_id' => $correctOptionId,
            'selected_option_id' => $data['option_id']
        );

        return json_encode($response);
    }

    public function createAttempt()
    {
        $requestData = $this->request->getJSON();
        $userId = $this->sessionData['id'];
        $taskId = $requestData->task_id;

        $taskAttemptModel = new TaskAttemptModel();

        // Check if an attempt already exists
        $existingAttempt = $taskAttemptModel->where([
            'user_id' => $userId,
            'task_id' => $taskId
        ])->first();

        if ($existingAttempt) {
            // Attempt exists, no insertion, proceed with success response
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Task attempt already exists, proceeding with task.',
                'task_attempt_id' => $existingAttempt['id']  // Return attempt ID if needed
            ]);
        }

        // Insert new attempt if it doesn’t exist
        $taskAttemptId = $taskAttemptModel->insert([
            'user_id' => $userId,
            'task_id' => $taskId,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'New task attempt created.',
            'task_attempt_id' => $taskAttemptId
        ]);
    }

    public function completeQuiz()
    {
        $requestData = $this->request->getJSON();
        $userId = $this->sessionData['id'];
        $taskId = $requestData->task_id;
        $topicId = $requestData->topic_id;
        $score = isset($requestData->score) ? $requestData->score : null;

        $taskAttemptModel = new TaskAttemptModel();

        // Mark the task attempt as completed
        $taskAttemptModel->markAsCompleted($userId, $taskId, $score);

        $this->checkTopicCompletion($topicId);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Task attempt marked as completed.'
        ]);
    }

    public function completeAssignment()
    {
        $requestData = $this->request->getJSON();
        $userId = $this->sessionData['id'];
        $taskId = $requestData->task_id;
        $topicId = $requestData->topic_id;

        $taskAttemptModel = new TaskAttemptModel();

        // Mark the task attempt as completed
        $taskAttemptModel->markAsCompleted($userId, $taskId);

        $this->checkTopicCompletion($topicId);
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Task attempt marked as completed.'
        ]);
    }

    public function checkTopicCompletion($topicId)
    {
        $progressModel = new ProgressModel();
        $progressModel->checkAndInsertProgress($this->sessionData['id'], $topicId);
    }
}
