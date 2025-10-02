<?php

namespace App\Controllers\API;

class QFCEvaluator extends \App\Controllers\BaseController
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
            return ['error' => $newThread['error']];
        }

        return $newThread;
    }

    public function deleteThread($thread_id)
    {
        $response = $this->openAIService->deleteThread($thread_id);
        return $response;
    }

    public function sendMessage($thread_id, $data)
    {
        $messageContent = $data;

        if (empty($messageContent)) {
            return ['error' => 'Message content is required'];
        }

        // Use OpenAIService to send the message to ChatGPT
        // Step 1: Create a message in the thread
        $messageResponse = $this->openAIService->createMessage($thread_id, $messageContent);

        if (isset($messageResponse['error'])) {
            return ['error' => $messageResponse['error']];
        }

        // Step 2: Create a new run in the thread
        $runResponse = $this->openAIService->createRun($thread_id, $this->assistantId);

        if (isset($runResponse['error'])) {
            return ['error' => $runResponse['error']];
        }

        $runId = $runResponse['id'];

        // Step 3: Wait for the run to complete
        $completedRun = $this->openAIService->waitForRunCompletion($thread_id, $runId);

        if (isset($completedRun['error'])) {
            return ['error' => 'Error completing run'];
        }

        // Step 4: Retrieve the latest message in the thread
        $messageList = $this->openAIService->listMessages($thread_id, 1);

        if (isset($messageList['error'])) {
            return ['error' => 'Error retrieving messages'];
        }

        $latestMessage = $messageList['data'][0]['content'][0]['text']['value'] ?? null;

        // Parse the response
        try {
            $parsedResponse = json_decode($latestMessage, true);

            if ($parsedResponse) {
                return $parsedResponse;
            }
        } catch (\Exception $e) {
            return ['error' => 'Unable to parse response: ' . $latestMessage];
        }

        return ['error' => 'Unexpected response type'];
    }
}
