<?php

namespace App\Controllers\Admin;

use App\Models\TopicModel;
use App\Models\TaskModel;
use CodeIgniter\Controller;

class Topic extends \App\Controllers\BaseController
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
        $topicModel = new TopicModel();
        $perPage = $this->request->getGet('perPage') ?? 25;
        $page = (int)($this->request->getGet('page') ?? 1);
        $searchTerm = $this->request->getGet('search');
        $courseId = $this->request->getGet('course_id');

        $offset = ($page - 1) * $perPage;
        $topics = $topicModel->getTopicsWithFilters($perPage, $offset, $searchTerm, $courseId);

        // no course enrichment here; course-topic relation is handled in a separate admin area

        // Get total count with optional search and course filter
        $total = $topicModel->getTotalTopics($searchTerm, $courseId);
        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $perPage, $total);

        return view('admin/pages/topics/index', [
            'sessionData' => $this->sessionData,
            'topics' => $topics,
            'pager' => $pager,
            'searchTerm' => $searchTerm,
            'perPage' => $perPage,
            'courseId' => $courseId,
        ]);
    }

    public function create()
    {
        return view('admin/pages/topics/create', [
            'sessionData' => $this->sessionData,
        ]);
    }

    public function store()
    {
        $topicModel = new TopicModel();
        $data = $this->request->getPost();

        // Validate the input data
        $validation = \Config\Services::validation();
        $validation->setRules($topicModel->getValidationRules(), $topicModel->getValidationMessages());

        if ($validation->run($data) === false) {
            return redirect()->to('/admin/topics/create')->withInput()->with('validation_errors', $validation->getErrors());
        }

        $insertId = $topicModel->insert($data);

        if ($insertId) {
            return redirect()->to('/admin/topics')->with('success', 'Topic created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create topic. Please try again.');
        }
    }

    public function edit($id)
    {
        $topicModel = new TopicModel();
        $topic = $topicModel->find($id);
        // no course/order info here; managed in separate admin area

        if (!$topic) {
            return redirect()->back()->with('error', 'Topic not found.');
        }

        return view('admin/pages/topics/edit', [
            'sessionData' => $this->sessionData,
            'topic' => $topic,
        ]);
    }

    public function update()
    {
        $topicModel = new TopicModel();
        $data = $this->request->getPost();
        $id = $data['id'];

        // Validate the input data
        $validation = \Config\Services::validation();
        $validation->setRules($topicModel->getValidationRules(), $topicModel->getValidationMessages());

        if ($validation->run($data) === false) {
            return redirect()->to('/admin/topics/' . $id . '/edit')->withInput()->with('validation_errors', $validation->getErrors());
        }

        if ($topicModel->update($id, $data)) {
            return redirect()->to('/admin/topics')->with('success', 'Topic updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update topic. Please try again.');
        }
    }

    public function show($id)
    {
        $topicModel = new TopicModel();
        $taskModel = new TaskModel();
        $topic = $topicModel->find($id);
        $tasks = $taskModel->where('topic_id', $id)->findAll();

        if (!$topic) {
            return redirect()->back()->with('error', 'Topic not found.');
        }

        return view('admin/pages/topics/show', [
            'sessionData' => $this->sessionData,
            'topic' => $topic,
            'tasks' => $tasks
        ]);
    }
}
