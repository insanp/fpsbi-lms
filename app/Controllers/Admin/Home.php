<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Home extends \App\Controllers\BaseController
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

  public function dashboard()
  {
    return view('admin/pages/dashboard', ['sessionData' => $this->sessionData]);
  }

  public function index()
  {
    return redirect()->to('admin/dashboard');
  }
}
