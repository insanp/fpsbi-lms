<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\CourseEnrollmentModel;
use App\Models\CourseModel;
use App\Models\TopicModel;
use App\Models\CourseTopicModel;
use App\Services\ProgressService;
use CodeIgniter\Controller;

class CourseEnrollments extends \App\Controllers\BaseController
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
        $ceModel = new CourseEnrollmentModel();
        $courseModel = new CourseModel();
        $perPage = $this->request->getGet('perPage') ?? 10;
        $page = (int)($this->request->getGet('page') ?? 1);
        $searchTerm = $this->request->getGet('search');
        $courseId = $this->request->getGet('course_id');

        $offset = ($page - 1) * $perPage;
        $enrollments = $ceModel->getEnrollmentsWithUser($perPage, $offset, $searchTerm, $courseId);

        // Get total count with optional search and course filter
        $total = $ceModel->getTotalEnrollments($searchTerm, $courseId);
        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $perPage, $total);

        // Fetch all courses for the dropdown
        $courses = $courseModel->findAll();

        return view('admin/pages/course_enrollments/index', [
            'sessionData' => $this->sessionData,
            'enrollments' => $enrollments,
            'pager' => $pager,
            'searchTerm' => $searchTerm,
            'perPage' => $perPage,
            'courseId' => $courseId,
            'courses' => $courses
        ]);
    }

    public function create()
    {
        $courseModel = new CourseModel();
        $validation_errors = session()->getFlashdata('validation_errors');

        // Fetch all courses for the dropdown
        $courses = $courseModel->findAll();

        return view('admin/pages/course_enrollments/create', [
            'sessionData' => $this->sessionData,
            'validation_errors' => $validation_errors,
            'courses' => $courses
        ]);
    }

    public function store()
    {
        // Retrieve and decode JSON input
        $input = $this->request->getJSON(true);
        // Safe guards for missing input
        $courseId = isset($input['course_id']) ? $input['course_id'] : null;
        $userIds = isset($input['user_ids']) ? $input['user_ids'] : [];
        $enrollAtList = isset($input['enroll_at']) ? $input['enroll_at'] : [];
        $accessUntilList = isset($input['access_until']) ? $input['access_until'] : [];

        $courseEnrollmentModel = new CourseEnrollmentModel();
        $userModel = new UserModel();

        // Track success and failure entries for feedback (include user details)
        $results = [
            'enrolled' => [],
            'skipped' => []
        ];

        foreach ($userIds as $index => $userId) {
            $data = [
                'course_id' => $courseId,
                'user_id' => $userId,
                'enrolled_at' => isset($enrollAtList[$index]) ? $enrollAtList[$index] : null,
                'access_until' => isset($accessUntilList[$index]) ? $accessUntilList[$index] : null
            ];

            // Special rule: If trying to enroll into COURSE_MFC but user never had COURSE_QFC,
            // skip enrollment and add a specific reason.
            $user = $userModel->find($userId);
            $userInfo = [
                'id' => $userId,
                'member_id' => $user['member_id'] ?? null,
                'name' => $user['name'] ?? null,
                'email' => $user['email'] ?? null,
            ];

            // Insert if no active enrollment exists
            $result = $courseEnrollmentModel->insertIfAccessExpired($data);

            if ($result) {
                $results['enrolled'][] = $userInfo; // Enrolled successfully
            } else {
                // If insertion failed because of active enrollment, add a generic reason
                $userInfo['reason'] = 'Skipped: active enrollment exists';
                $results['skipped'][] = $userInfo;
            }
        }

        // Store results in flashdata so the index page can display enrolled/skipped lists
        session()->setFlashdata('enrollment_results', $results);

        // Return a JSON payload containing redirect URL for the client to follow
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Enrollments processed',
            'redirect' => base_url('admin/course-enrollments')
        ]);
    }

    public function delete($id)
    {
        $ceModel = new CourseEnrollmentModel();

        // Attempt to delete the enrollment
        if ($ceModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Course enrollment deleted successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete course enrollment. Please try again.'
            ])->setStatusCode(500);
        }
    }

    public function edit($id)
    {
        $ceModel = new CourseEnrollmentModel();
        $enrollment = $ceModel->find($id);

        if (!$enrollment) {
            return redirect()->back()->with('error', 'Enrollment not found.');
        }

        return view('admin/pages/course_enrollments/edit', [
            'sessionData' => $this->sessionData,
            'enrollment' => $enrollment
        ]);
    }

    public function update()
    {
        $ceModel = new CourseEnrollmentModel();

        // Retrieve the ID from the POST request
        $id = $this->request->getPost('id');

        // Retrieve the dates to update
        $data = $this->request->getPost([
            'enrolled_at',
            'access_until'
        ]);

        if ($ceModel->update($id, $data)) {
            return redirect()->to('/admin/course-enrollments')->with('success', 'Enrollment updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update enrollment. Please try again.');
        }
    }

    public function showUserProgress($userId, $courseId)
    {
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $topicModel = new TopicModel();
        $progressService = new ProgressService();

        // Step 1: Get topics with completion status for the given course and user
        $topics = $topicModel->getTopicsWithCompletionStatus($courseId, $userId);

        // Step 2: Determine topic access
        $topicAccess = $progressService->determineTopicAccess($topics);
        $topics = $topicAccess['topics'];

        // Step 3: Calculate progress percentage
        $progressPercentage = $progressService->getProgressPercentage($courseId, $userId);

        // Step 4: Pass data to the admin view
        return view('admin/pages/course_enrollments/user_progress', [
            'sessionData' => $this->sessionData,
            'user' => $user,
            'userId' => $userId,
            'courseId' => $courseId,
            'topics' => $topics,
            'progressPercentage' => round($progressPercentage, 2)
        ]);
    }

    public function refreshUserProgress($userId, $courseId)
    {
        $courseTopicModel = new CourseTopicModel();
        // getTopicsByCourse returns topic rows joined with course_topics; it may return objects
        $topics = $courseTopicModel->getTopicsByCourse($courseId, $userId);
        $progressService = new ProgressService();

        foreach ($topics as $topic) {
            $progressService->checkAndUpdateProgress(['id' => $userId], $topic['id'], true);
        }

        return redirect()->back()->with('success', 'User progress refreshed successfully.');
    }
}
