<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Services\CourseEnrollmentService;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function login()
    {
        // Load the UserModel
        $userModel = new UserModel();

        // Get the posted email and password from the form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Validate login credentials using the UserModel
        $result = $userModel->validateLogin($email, $password);

        // Check the result
        if (isset($result['error'])) {
            // Validation failed, display errors or redirect back to the login form
            return redirect()->to('/auth/login-form')->withInput()->with('validation_errors', $result['error']);
        } else {
            // successful login
            $session = session();
            $session->set('user', $result['user']);

            // Populate available courses and tools access in session
            $this->populateAvailableCourses($result['user']['id']);

            $redirectURL = session()->get('redirect_url') ?? '/';
            $session->remove('redirect_url');

            return redirect()->to($redirectURL);
        }
    }

    public function logout()
    {
        $session = session();
        if ($session->get('inactive')) {
            $mode = 'inactive=1';
        } else {
            $mode = 'logout=1';
        }
        $session->destroy();

        return redirect()->to('/auth/login-form?' . $mode);
    }

    public function showLoginForm()
    {
        $validation_errors = session()->getFlashdata('validation_errors');
        $inactive = $this->request->getGet('inactive');
        $logout = $this->request->getGet('logout');
        $message = session()->getFlashdata('message');;
        if ($inactive) {
            $message = 'Akun Anda tidak aktif. Harap hubungi admin untuk mengaktifkan akun Anda.';
        } elseif ($logout) {
            $message = 'Anda berhasil logout.';
        }
        return view('admin/pages/login', [
            'validation_errors' => $validation_errors,
            'message' => $message
        ]);
    }

    public function refreshSession()
    {
        $session = session();

        // Check if the user is logged in
        if ($session->has('user')) {
            // Get the user data from the session
            $userData = $session->get('user');

            // Load the UserModel
            $userModel = new UserModel();

            // Check if the user still exists in the database
            $user = $userModel->find($userData['id']);

            if ($user) {
                // Update the user data in the session
                $session->set('user', $user);

                // Populate available courses and tools access in session
                $this->populateAvailableCourses($userData['id']);
            } else {
                // User no longer exists, logout the user
                $this->logout();
            }
        }
    }

    private function populateAvailableCourses($userId)
    {
        $currentDate = date('Y-m-d H:i:s');
        // Use the new service to get active enrollments
        $enrollmentService = new CourseEnrollmentService();
        $activeEnrollments = $enrollmentService->getActiveEnrollments($userId, $currentDate);

        $session = session();
        $sessionData = $session->get('user');
        $sessionData['active_enrollments'] = array_column($activeEnrollments, 'access_until', 'course_id');
        $sessionData['alumni'] = $this->getAlumniStatus($userId);
        $session->set('user', $sessionData);
    }

    private function getAlumniStatus($userId)
    {
        $alumniModel = new \App\Models\AlumniModel();
        $alumni = $alumniModel->where('user_id', $userId)->findAll();
        $alumniStatus = [];
        foreach ($alumni as $alum) {
            $alumniStatus[$alum['course_id']] = true;
        }
        return $alumniStatus;
    }
}
