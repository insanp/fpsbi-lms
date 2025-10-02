<?php

namespace App\Controllers\Member;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Profile extends \App\Controllers\BaseController
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
    $userModel = new UserModel();
    $data = array();
    $data['sessionData'] = $this->sessionData;
    $data['user'] = $userModel->find($this->sessionData['id']);

    return view('member/pages/profile/index', $data);
  }

  public function edit()
  {
    $validation_errors = session()->getFlashdata('validation_errors');

    $userModel = new UserModel();
    $data = array();
    $data['sessionData'] = $this->sessionData;
    $data['user'] = $userModel->find($this->sessionData['id']);
    $data['validation_errors'] = $validation_errors;

    return view('member/pages/profile/edit', $data);
  }

  public function update()
  {
    $userModel = new UserModel();

    $formData = $this->request->getPost();
    $formData['id'] = (int) $this->sessionData['id'];
    $formData['member_id'] = $this->sessionData['member_id'];
    $formData['is_active'] = $this->sessionData['is_active'];
    $formData['is_admin'] = $this->sessionData['is_admin'];

    // Validate the input data
    $validation = \Config\Services::validation();
    $validation->setRules($userModel->getValidationRules(), $userModel->getValidationMessages());

    if (empty($formData['password']) && empty($formData['password_confirm'])) {
      $validation->setRule('password', 'password', 'permit_empty');
      $validation->setRule('password_confirm', 'password_confirm', 'permit_empty');
    }

    if ($validation->run($formData) === false) {
      return redirect()->to('/member/profile/edit')->withInput()->with('validation_errors', $validation->getErrors());
    }

    $userData = [
      'id' => $formData['id'],
      'member_id' => $formData['member_id'],
      'email' => $formData['email'],
      'name' => $formData['name'],
      'is_active' => $formData['is_active'],
      'is_admin' => $formData['is_admin'],
      'is_fresh_acc' => 0
    ];

    if (!empty($formData['password']) && !empty($formData['password_confirm'])) {
      $userData['password'] = $formData['password'];
      $userData['password_confirm'] = $formData['password_confirm'];
    }

    $userModel->update($formData['id'], $userData);

    $sql = $userModel->getLastQuery();
    log_message('info', 'Insert SQL: ' . $sql);

    // Check for database errors
    $dbErrors = $userModel->db->error();
    if (!empty($dbErrors)) {
      // Log database errors
      log_message('error', 'Database error: ' . print_r($dbErrors, true));
    }

    $authController = new \App\Controllers\Auth();
    $authController->refreshSession();

    return redirect()->to('/member/profile');
  }
}
