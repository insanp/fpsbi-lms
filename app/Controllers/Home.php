<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Home extends BaseController
{
  private $cache;

  public function __construct()
  {
    $this->cache = \Config\Services::cache();
  }

  public function index()
  {
    return redirect()->to('/member');
  }
}
