<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Users extends \App\Controllers\BaseController
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
    $perPage = $this->request->getGet('perPage') ?? 10;

    $searchTerm = $this->request->getGet('search');

    if ($searchTerm) {
      // if search exists
      $users = $userModel->searchUsers($searchTerm)->paginate($perPage);
    } else {
      // default
      $users = $userModel->orderBy('id', 'desc')->paginate($perPage);
    }

    return view('admin/pages/users/index', [
      'sessionData' => $this->sessionData,
      'users' => $users,
      'pager' => $userModel->pager,
      'searchTerm' => $searchTerm,
      'perPage' => $perPage
    ]);
  }

  public function create()
  {
    $userModel = new UserModel();
    $memberId = $userModel->generateMemberId();
    $validation_errors = session()->getFlashdata('validation_errors');
    return view('admin/pages/users/create', [
      'memberId' => $memberId,
      'sessionData' => $this->sessionData,
      'validation_errors' => $validation_errors
    ]);
  }

  public function store()
  {
    $userModel = new UserModel();

    $formData = $this->request->getPost();
    $formData['is_active'] = isset($formData['is_active']) ? 1 : 0;
    $formData['is_admin'] = isset($formData['is_admin']) ? 1 : 0;

    // Validate the input data
    $validation = \Config\Services::validation();
    $validation->setRules($userModel->getValidationRules(), $userModel->getValidationMessages());

    if ($validation->run($formData) === false) {
      return redirect()->to('/admin/users/create')->withInput()->with('validation_errors', $validation->getErrors());
    }

    $userData = [
      'member_id' => $formData['member_id'],
      'email' => $formData['email'],
      'name' => $formData['name'],
      'password' => $formData['password'],
      'password_confirm' => $formData['password_confirm'],
      'is_active' => $formData['is_active'],
      'is_admin' => $formData['is_admin'],
    ];

    $userModel->insert($userData);

    return redirect()->to('/admin/users');
  }

  public function show($id)
  {
    $userModel = new UserModel();
    $data = array();
    $data['sessionData'] = $this->sessionData;
    $data['user'] = $userModel->find($id);

    return view('admin/pages/users/show', $data);
  }

  public function edit($id)
  {
    $validation_errors = session()->getFlashdata('validation_errors');

    $userModel = new UserModel();
    $data = array();
    $data['sessionData'] = $this->sessionData;
    $data['user'] = $userModel->find($id);
    $data['validation_errors'] = $validation_errors;

    return view('admin/pages/users/edit', $data);
  }

  public function update()
  {
    $userModel = new UserModel();

    $formData = $this->request->getPost();
    $formData['id'] = (int) $formData['id'];
    $formData['is_active'] = isset($formData['is_active']) ? 1 : 0;
    $formData['is_admin'] = isset($formData['is_admin']) ? 1 : 0;

    // Validate the input data
    $validation = \Config\Services::validation();
    $validation->setRules($userModel->getValidationRules(), $userModel->getValidationMessages());

    if (empty($formData['password']) && empty($formData['password_confirm'])) {
      $validation->setRule('password', 'password', 'permit_empty');
      $validation->setRule('password_confirm', 'password_confirm', 'permit_empty');
    }

    if ($validation->run($formData) === false) {
      return redirect()->to('/admin/users/' . $formData['id'] . '/edit')->withInput()->with('validation_errors', $validation->getErrors());
    }

    $userData = [
      'id' => $formData['id'],
      'member_id' => $formData['member_id'],
      'email' => $formData['email'],
      'name' => $formData['name'],
      'is_active' => $formData['is_active'],
      'is_admin' => $formData['is_admin'],
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

    return redirect()->to('/admin/users');
  }

  public function searchSuggestion()
  {
    $query = $this->request->getGet('query');
    $userModel = new UserModel();
    $users = $userModel->like('member_id', $query)
      ->orLike('name', $query)
      ->orLike('email', $query)
      ->findAll();

    // Return suggestions as HTML for the AJAX response
    foreach ($users as $user) {
      echo "<div class='suggestion btn btn-secondary mb-1' onclick='selectUser(" . json_encode($user) . ")'>" . esc($user['member_id']) . ' - ' . esc($user['name']) . " (" . esc($user['email']) . ")</div><br/>";
    }
  }
}
