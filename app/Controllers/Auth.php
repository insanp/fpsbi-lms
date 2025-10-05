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

    // Handle forgot password request
    public function forgotPassword()
    {
        $email = $this->request->getPost('email');
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (isset($user['is_active']) && !$user['is_active']) {
                // User exists but is not active
                return redirect()->to('/auth/login-form')->with('message', 'Akun Anda tidak aktif. Harap hubungi admin untuk mengaktifkan akun Anda.');
            }
            // Generate a secure token
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));
            $resetModel = new \App\Models\PasswordResetModel();
            $resetModel->insert([
                'user_id' => $user['id'],
                'token' => $token,
                'expires_at' => $expires,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Send email with user name
            $this->sendResetEmail($user['email'], $token, $user['member_id'], $user['name']);
        }
        // Always show the same message for security
        return redirect()->to('/auth/login-form')->with('message', 'Jika email terdaftar, link reset password telah dikirim.');
    }

    public function sendResetEmail($email, $token, $member_id, $name)
    {
        $emailService = \Config\Services::email();

        $data = array(
            'member_id' => $member_id,
            'name' => $name,
            'email' => $email,
            'link' => base_url("auth/reset-password/{$token}")
        );
        $htmlData = view('emails/reset_password', ['data' => $data]);

        $emailService->setTo($email); // Send to user
        $emailService->setSubject('LMS FPSB Indonesia - Permintaan Reset Password');
        $emailService->setMessage($htmlData); // HTML content
        $emailService->setMailType('html');
        $emailService->send();
    }

    // Handle reset password link: validate token, login user, redirect to profile edit
    public function resetPassword($token)
    {
        $resetModel = new \App\Models\PasswordResetModel();
        $reset = $resetModel->where('token', $token)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->first();

        if (!$reset) {
            return redirect()->to('/auth/login-form')->with('message', 'Link reset password tidak valid atau sudah kedaluwarsa.');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($reset['user_id']);
        if (!$user) {
            return redirect()->to('/auth/login-form')->with('message', 'User tidak ditemukan.');
        }

        // Log the user in
        $session = session();
        $session->set('user', $user);

        // Optionally, delete the token so it can't be reused
        $resetModel->delete($reset['id']);

        // Redirect to profile edit with message
        return redirect()->to('/member/profile/edit')->with('message', 'Silakan update password sekarang.');
    }
}
