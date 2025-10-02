<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class ClientForms extends BaseController
{
  private $cache;

  public function __construct()
  {
    $this->cache = \Config\Services::cache();
  }

  public function index()
  {

  }

  public function show($encId) {

  }

  public function process($encId) {

  }

}
