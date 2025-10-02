<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\ArticleModel;
use CodeIgniter\Controller;

class Articles extends \App\Controllers\BaseController
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
    $articleModel = new ArticleModel();
    $articles = $articleModel->findAll();

    return view('admin/pages/articles/index', [
      'sessionData' => $this->sessionData,
      'articles' => $articles
    ]);
  }

  public function create()
  {
    $validation_errors = session()->getFlashdata('validation_errors');
    return view('admin/pages/articles/create', [
      'sessionData' => $this->sessionData, 'validation_errors' => $validation_errors
    ]);
  }

  public function store()
  {
    $articleModel = new ArticleModel();

    $formData = $this->request->getPost();

    // Add slug to the form data
    $formData['content'] = sanitize_html($formData['content']);
    $formData['slug'] = convert_to_slug($formData['title']);

    // Validate the input data
    $validation = \Config\Services::validation();
    $validation->setRules($articleModel->getValidationRules(), $articleModel->getValidationMessages());

    if ($validation->run($formData) === false) {
      return redirect()->to('/admin/articles/create')->withInput()->with('validation_errors', $validation->getErrors());
    }

    // process new article
    $articleData = [
      'title' => $formData['title'],
      'slug' => $formData['slug'],
      'resume' => $formData['resume'],
      'content' => $formData['content'],
      'status' => $formData['status'],
      'author_id' => $this->sessionData['id'],
    ];

    $articleModel->insert($articleData);

    return redirect()->to('/admin/articles');
  }

  public function show($id)
  {
    $articleModel = new ArticleModel();
    $data = array();
    $data['sessionData'] = $this->sessionData;
    $data['article'] = $articleModel->find($id);

    return view('admin/pages/articles/show', $data);
  }

  public function edit($id)
  {
    $validation_errors = session()->getFlashdata('validation_errors');

    $articleModel = new ArticleModel();
    $data = array();
    $data['sessionData'] = $this->sessionData;
    $data['article'] = $articleModel->find($id);
    $data['validation_errors'] = $validation_errors;

    return view('admin/pages/articles/edit', $data);
  }

  public function update()
  {
    $articleModel = new ArticleModel();

    $formData = $this->request->getPost();

    // Add slug to the form data
    $formData['id'] = (int) $formData['id'];
    $formData['content'] = sanitize_html($formData['content']);
    $formData['slug'] = convert_to_slug($formData['title']);

    // Validate the input data
    $validation = \Config\Services::validation();
    $validation->setRules($articleModel->getValidationRules(), $articleModel->getValidationMessages());

    if ($validation->run($formData) === false) {
      return redirect()->to('/admin/articles/'.$formData['id'].'/edit')->withInput()->with('validation_errors', $validation->getErrors());
    }

    // update article
    $articleData = [
      'id' => $formData['id'],
      'title' => $formData['title'],
      'slug' => $formData['slug'],
      'resume' => $formData['resume'],
      'content' => $formData['content'],
      'status' => $formData['status'],
    ];

    $articleModel->update($formData['id'], $articleData);

    $sql = $articleModel->getLastQuery();
    log_message('info', 'Insert SQL: ' . $sql);

    // Check for database errors
    $dbErrors = $articleModel->db->error();
    if (!empty($dbErrors)) {
      // Log database errors
      log_message('error', 'Database error: ' . print_r($dbErrors, true));
    }

    return redirect()->to('/admin/articles');
  }
}
