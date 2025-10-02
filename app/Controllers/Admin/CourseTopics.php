<?php

namespace App\Controllers\Admin;

use App\Models\CourseTopicModel;
use App\Models\CourseModel;
use App\Models\TopicModel;

class CourseTopics extends \App\Controllers\BaseController
{
    private $session;
    private $sessionData;

    public function __construct()
    {
        $this->session = session();
        $this->sessionData = $this->session->get('user');
    }
    public function index()
    {
        $model = new CourseTopicModel();
        $perPage = $this->request->getGet('perPage') ?? 25;
        $page = (int)($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $items = $model->select('course_topics.*, courses.name as course_name, topics.title as topic_title')
            ->join('courses', 'courses.id = course_topics.course_id', 'left')
            ->join('topics', 'topics.id = course_topics.topic_id', 'left')
            ->orderBy('course_topics.order_no', 'asc')
            ->findAll((int)$perPage, (int)$offset);

    // count total mappings (simple approach)
    $total = $model->countAllResults();
        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $perPage, $total);

        return view('admin/pages/course_topics/index', [
            'sessionData' => $this->sessionData,
            'items' => $items,
            'pager' => $pager,
            'perPage' => $perPage,
        ]);
    }

    public function create()
    {
        $courseModel = new CourseModel();
        $topicModel = new TopicModel();

        return view('admin/pages/course_topics/create', [
            'sessionData' => $this->session->get('user'),
            'courses' => $courseModel->findAll(),
            'topics' => $topicModel->findAll(),
        ]);
    }

    public function store()
    {
        $model = new CourseTopicModel();
        $data = $this->request->getPost();

        $validation = \Config\Services::validation();
        $validation->setRules($model->getValidationRules());

        if ($validation->run($data) === false) {
            return redirect()->to('/admin/course-topics/create')->withInput()->with('validation_errors', $validation->getErrors());
        }

        if ($model->insert($data)) {
            return redirect()->to('/admin/course-topics')->with('success', 'Course-Topic mapping created.');
        }

        return redirect()->back()->with('error', 'Failed to create mapping.');
    }

    public function edit($id)
    {
        $model = new CourseTopicModel();
        $courseModel = new CourseModel();
        $topicModel = new TopicModel();

        $item = $model->find($id);
        if (!$item) return redirect()->back()->with('error', 'Mapping not found.');

        return view('admin/pages/course_topics/edit', [
            'sessionData' => $this->session->get('user'),
            'item' => $item,
            'courses' => $courseModel->findAll(),
            'topics' => $topicModel->findAll(),
        ]);
    }

    public function update()
    {
        $model = new CourseTopicModel();
        $data = $this->request->getPost();
        $id = $data['id'] ?? null;

        if (!$id) return redirect()->back()->with('error', 'Missing id');

        $validation = \Config\Services::validation();
        $validation->setRules($model->getValidationRules());

        if ($validation->run($data) === false) {
            return redirect()->to('/admin/course-topics/' . $id . '/edit')->withInput()->with('validation_errors', $validation->getErrors());
        }

        if ($model->update($id, $data)) {
            return redirect()->to('/admin/course-topics')->with('success', 'Mapping updated.');
        }

        return redirect()->back()->with('error', 'Failed to update mapping.');
    }

    public function delete($id)
    {
        $model = new CourseTopicModel();
        if ($model->delete($id)) {
            return $this->response->setJSON(['status' => 'success']);
        }
        return $this->response->setJSON(['status' => 'error']);
    }
}
