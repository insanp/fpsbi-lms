<?php

namespace App\Services;

class OpenAIService
{
    protected $apiKey;
    protected $baseUrl = "https://api.openai.com/v1";

    public function __construct()
    {
        $this->apiKey = getenv('OPENAI_API_KEY');
    }

    private function sendRequest($endpoint, $method = 'POST', $data = [])
    {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
            'OpenAI-Beta: assistants=v2'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        } elseif ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => curl_error($ch)];
        }

        curl_close($ch);
        return json_decode($response, true);
    }

    public function createNewThread()
    {
        $data = [
            "tool_resources" => [
                "file_search" => [
                    "vector_store_ids" => ["vs_LLpTQAkQVjLPmBxJQs7yKi5A"]
                ]
            ]
        ];

        return $this->sendRequest('/threads', 'POST', $data);
    }

    public function deleteThread($thread_id)
    {
        return $this->sendRequest("/threads/{$thread_id}", 'DELETE');
    }

    public function createMessage($thread_id, $content)
    {
        $data = [
            "role" => "user",
            "content" => $content
        ];

        return $this->sendRequest("/threads/{$thread_id}/messages", 'POST', $data);
    }

    public function createRun($thread_id, $assistant_id)
    {
        $data = [
            "assistant_id" => $assistant_id
        ];

        return $this->sendRequest("/threads/{$thread_id}/runs", 'POST', $data);
    }

    public function retrieveRun($thread_id, $run_id)
    {
        return $this->sendRequest("/threads/{$thread_id}/runs/{$run_id}", 'GET');
    }

    public function listMessages($thread_id, $limit = 1)
    {
        return $this->sendRequest("/threads/{$thread_id}/messages?limit={$limit}", 'GET');
    }

    public function waitForRunCompletion($thread_id, $run_id)
    {
        while (true) {
            sleep(1);
            $runStatus = $this->retrieveRun($thread_id, $run_id);

            if (isset($runStatus['completed_at'])) {
                return $runStatus;
            }
        }
    }
}
