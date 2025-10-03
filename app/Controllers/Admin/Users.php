<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Users extends BaseController
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
      $users = $userModel->searchUsers($searchTerm)->paginate($perPage);
    } else {
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

  // AJAX endpoint: upload file, save to temp, return token
  public function uploadImportFile()
  {
    $file = $this->request->getFile('excelFile');
    if (!$file || !$file->isValid()) {
      return $this->response->setJSON(['success' => false, 'error' => 'No file uploaded or file is invalid.']);
    }
    $newName = uniqid('import_', true) . '.' . $file->getExtension();
    $path = WRITEPATH . 'uploads/' . $newName;
    $file->move(WRITEPATH . 'uploads', $newName);
    return $this->response->setJSON(['success' => true, 'token' => $newName]);
  }

  // AJAX endpoint: process a batch of rows from the uploaded file
  public function processImportBatch()
  {
    $token = $this->request->getPost('token');
    $batch = (int)$this->request->getPost('batch');
    $batchSize = (int)$this->request->getPost('batchSize') ?: 200;
    $filePath = WRITEPATH . 'uploads/' . $token;
    if (!is_file($filePath)) {
      return $this->response->setJSON(['success' => false, 'error' => 'File not found.']);
    }
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $rows = [];
    if ($extension === 'csv') {
      if (($handle = fopen($filePath, 'r')) !== false) {
        while (($data = fgetcsv($handle, 0, ';')) !== false) {
          $rows[] = $data;
        }
        fclose($handle);
      }
    } else {
      require_once(ROOTPATH . 'vendor/autoload.php');
      $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
      $sheet = $spreadsheet->getActiveSheet();
      $rows = $sheet->toArray();
    }
    if (count($rows) < 3) {
      return $this->response->setJSON(['success' => false, 'error' => 'File must have at least 3 rows (header at row 3).']);
    }
    $header = $rows[2];
    $headerLower = array_map('strtolower', $header);
    $nameIdx = array_search('name', $headerLower);
    $emailPersonIdx = array_search('email person', $headerLower);
    $emailOfficeIdx = array_search('email office', $headerLower);
    $fpsbMemberIdIdx = array_search('member id', $headerLower);
    if ($nameIdx === false || ($emailPersonIdx === false && $emailOfficeIdx === false) || $fpsbMemberIdIdx === false) {
      return $this->response->setJSON(['success' => false, 'error' => 'File must have columns: Name, Email Person or Email Office, Member ID.']);
    }
    $startRow = 3 + $batch * $batchSize;
    $endRow = min($startRow + $batchSize, count($rows));
    $userModel = new UserModel();
    $imported = 0;
    $updated = 0;
    $importedUsers = [];
    $updatedUsers = [];
    for ($i = $startRow; $i < $endRow; $i++) {
      $row = $rows[$i];
      $name = isset($row[$nameIdx]) ? trim($row[$nameIdx]) : '';
      $emailPerson = ($emailPersonIdx !== false && isset($row[$emailPersonIdx])) ? trim($row[$emailPersonIdx]) : '';
      $emailOffice = ($emailOfficeIdx !== false && isset($row[$emailOfficeIdx])) ? trim($row[$emailOfficeIdx]) : '';
      $email = $emailPerson ?: $emailOffice;
      $fpsbMemberId = isset($row[$fpsbMemberIdIdx]) ? trim($row[$fpsbMemberIdIdx]) : '';
      // Remove spaces and take first 8 chars only
      $fpsbMemberId = substr(str_replace(' ', '', $fpsbMemberId), 0, 8);
      if (!$name || !$email || !$fpsbMemberId) continue;
      $existing = $userModel->where('email', $email)->first();
      if ($existing) {
        $userModel->update($existing['id'], [
          'name' => $name,
          'member_id' => $fpsbMemberId
        ]);
        $updated++;
        $updatedUsers[] = [
          'name' => $name,
          'email' => $email
        ];
      } else {
        $userData = [
          'member_id' => $fpsbMemberId,
          'name' => $name,
          'email' => $email,
          'cfp_member_id' => $fpsbMemberId,
          'password' => '',
          'password_confirm' => '',
          'is_active' => 0,
        ];
        $validation = \Config\Services::validation();
        $validation->setRules($userModel->getValidationRules(), $userModel->getValidationMessages());
        if ($validation->run($userData)) {
          $userModel->insert($userData);
          $imported++;
          $importedUsers[] = [
            'name' => $name,
            'email' => $email
          ];
        } else {
          $failedUsers[] = [
            'name' => $name,
            'email' => $email,
            'error' => implode('; ', $validation->getErrors())
          ];
        }
      }
    }
    $totalRows = count($rows) - 3;
    $processed = min(($batch + 1) * $batchSize, $totalRows);
    $done = $processed >= $totalRows;
    return $this->response->setJSON([
      'success' => true,
      'imported' => $imported,
      'updated' => $updated,
      'processed' => $processed,
      'total' => $totalRows,
      'done' => $done,
      'importedUsers' => $importedUsers,
      'updatedUsers' => $updatedUsers,
      'failedUsers' => isset($failedUsers) ? $failedUsers : []
    ]);
  }
}
