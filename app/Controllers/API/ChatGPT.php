<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class ChatGPT extends ResourceController
{
    protected $openAIService;
    protected $assistantId = 'asst_aEEhGyqvthZIUQ7uC2v80H8u';

    public function __construct()
    {
        $this->openAIService = service('openAI');
    }

    public function createNewThread()
    {
        $newThread = $this->openAIService->createNewThread();

        if (isset($newThread['error'])) {
            return $this->respond(['error' => $newThread['error']]);
        }

        return $this->respond($newThread);
    }

    public function deleteThread($thread_id)
    {
        $response = $this->openAIService->deleteThread($thread_id);
        return $this->respond($response);
    }

    public function sendMessage($thread_id)
    {
        // Retrieve JSON data from the request
        $jsonData = $this->request->getJSON();
        $messageContent = $jsonData->message ?? null;

        if (empty($messageContent)) {
            return $this->respond(['error' => 'Message content is required'], 400);
        }

        // Use OpenAIService to send the message to ChatGPT
        // Step 1: Create a message in the thread
        $messageResponse = $this->openAIService->createMessage($thread_id, $messageContent);

        if (isset($messageResponse['error'])) {
            return $this->respond(['error' => $messageResponse['error']], 500);
        }

        // Step 2: Create a new run in the thread
        $runResponse = $this->openAIService->createRun($thread_id, $this->assistantId);

        if (isset($runResponse['error'])) {
            return $this->respond(['error' => $runResponse['error']], 500);
        }

        $runId = $runResponse['id'];

        // Step 3: Wait for the run to complete
        $completedRun = $this->openAIService->waitForRunCompletion($thread_id, $runId);

        if (isset($completedRun['error'])) {
            return $this->respond(['error' => 'Error completing run'], 500);
        }

        // Step 4: Retrieve the latest message in the thread
        $messageList = $this->openAIService->listMessages($thread_id, 1);

        if (isset($messageList['error'])) {
            return $this->respond(['error' => 'Error retrieving messages'], 500);
        }

        $latestMessage = $messageList['data'][0]['content'][0]['text']['value'] ?? null;

        // Parse the response
        try {
            $parsedResponse = json_decode($latestMessage, true);

            if ($parsedResponse) {
                return $this->respond($parsedResponse);
            }
        } catch (\Exception $e) {
            return $this->respond(['error' => 'Unable to parse response: ' . $latestMessage], 500);
        }

        return $this->respond(['error' => 'Unexpected response type']);
    }
}
