<?php

namespace App\Controllers\Admin;

use App\Models\OtherAnswerModel;
use App\Services\QFCPart2AnalysisService;
use CodeIgniter\Controller;

class OtherAnswers extends \App\Controllers\BaseController
{
    private $session;
    private $sessionData;

    public function __construct()
    {
        // Ensure the session library is loaded
        $this->session = session();

        // Load the UserModel or any other necessary models
        $this->sessionData = $this->session->get('user');
    }

    public function index()
    {
        $otherAnswerModel = new OtherAnswerModel();
        $perPage = $this->request->getGet('perPage') ?? 10;

        $otherAnswer = $otherAnswerModel->groupStart()
            ->where('feedback', '')
            ->orWhere('feedback IS NULL', null, false)
            ->groupEnd()
            ->orderBy('id', 'DESC')->paginate($perPage);

        return view('admin/pages/other-answers/index', [
            'sessionData' => $this->sessionData,
            'otherAnswers' => $otherAnswer,
            'pager' => $otherAnswerModel->pager,
            'perPage' => $perPage
        ]);
    }

    public function reprocessFeedback($taskAttemptId)
    {
        try {
            // Call the service
            $qfcPart2AnalysisService = new QFCPart2AnalysisService();
            $result = $qfcPart2AnalysisService->analyze($taskAttemptId);

            // Return a success message
            return redirect()->to('/admin/other-answers')->with('message', 'Feedback reprocessed successfully for task attempt ID: ' . $taskAttemptId);
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->to('/admin/other-answers')->with('error', $e->getMessage());
        }
    }
}
