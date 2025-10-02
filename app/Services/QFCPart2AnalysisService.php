<?php
namespace App\Services;

use App\Models\OtherAnswerModel;
use App\Models\TaskAttemptModel;
use App\Controllers\API\QFCEvaluator;

class QFCPart2AnalysisService
{
    public function analyze($taskAttemptId)
    {
        // Step 1: Load the other_answers model and get the answer data
        $otherAnswerModel = new OtherAnswerModel();
        $answerData = $otherAnswerModel->where('task_attempt_id', $taskAttemptId)->first();

        if (!$answerData) {
            throw new \Exception('Answer not found for the given task attempt ID.');
        }

        // Step 2: Decode the JSON answer data
        $answerJson = json_decode($answerData['answer'], true);
        $selectedCase = $answerJson['selected_case'] ?? 1;

        // Step 3: Perform any additional analysis on the data
        $analysis = [
            'pilihan_studi_kasus' => $selectedCase,
            'jawaban1' => $answerJson['answers'][$selectedCase][1] ?? null,
            'jawaban2' => $answerJson['answers'][$selectedCase][2] ?? null,
            'jawaban3' => $answerJson['answers'][$selectedCase][3] ?? null,
            'jawaban4' => $answerJson['answers'][$selectedCase][4] ?? null,
        ];

        $messageContent = json_encode($analysis);

        // Step 4: Instantiate QFCEvaluator
        $qfcEvaluator = new QFCEvaluator();

        // Create a new thread
        $newThreadData = $qfcEvaluator->createNewThread();
        if (isset($newThreadData['error'])) {
            throw new \Exception('Error creating new thread.');
        }

        $threadId = $newThreadData['id'];

        // Send message
        $messageResponse = $qfcEvaluator->sendMessage($threadId, $messageContent);
        if (isset($messageResponse['error'])) {
            throw new \Exception('Error sending message: ' . $messageResponse['error']);
        }

        $openAIResponse = $messageResponse['response'] ?? 'No response';

        // Update feedback in the database
        $otherAnswerModel->where('task_attempt_id', $taskAttemptId)
            ->set('feedback', json_encode($messageResponse))
            ->update();

        // Mark task as completed
        $taskAttemptModel = new TaskAttemptModel();
        $taskAttemptModel->markAsCompletedByAttemptId($taskAttemptId, $messageResponse['total_penilaian'] * 5);

        // Delete thread
        $deleteResponse = $qfcEvaluator->deleteThread($threadId);
        if (isset($deleteResponse['error'])) {
            throw new \Exception('Error deleting thread.');
        }

        return [
            'openai_response' => $openAIResponse,
            'thread_created' => $newThreadData,
            'answers' => json_decode($messageContent),
            'message_sent' => $messageResponse,
            'thread_deleted' => $deleteResponse,
        ];
    }
}
