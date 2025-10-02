<?php

namespace App\Controllers\Admin;

use App\Models\AlumniModel;
use App\Models\CourseModel;
use CodeIgniter\Controller;

class Alumni extends \App\Controllers\BaseController
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
        $alumniModel = new AlumniModel();
        $courseModel = new CourseModel();
        $perPage = $this->request->getGet('perPage') ?? 10;
        $page = (int)($this->request->getGet('page') ?? 1);
        $searchTerm = $this->request->getGet('search');
        $courseId = $this->request->getGet('course_id');

        $offset = ($page - 1) * $perPage;
        $alumni = $alumniModel->getAlumniWithUser($perPage, $offset, $searchTerm, $courseId);

        $total = $alumniModel->getTotalAlumni($searchTerm, $courseId);
        $pager = \Config\Services::pager();
        $pager->makeLinks($page, $perPage, $total);

        $courses = $courseModel->findAll();

        return view('admin/pages/alumni/index', [
            'sessionData' => $this->sessionData,
            'alumni' => $alumni,
            'pager' => $pager,
            'searchTerm' => $searchTerm,
            'perPage' => $perPage,
            'courseId' => $courseId,
            'courses' => $courses
        ]);
    }

    public function create()
    {
        $courseModel = new CourseModel();
        $validation_errors = session()->getFlashdata('validation_errors');

        $courses = $courseModel->findAll();

        return view('admin/pages/alumni/create', [
            'sessionData' => $this->sessionData,
            'validation_errors' => $validation_errors,
            'courses' => $courses
        ]);
    }

    public function store()
    {
        $input = $this->request->getJSON(true);

        $courseId = $input['course_id'];
        $userIds = $input['user_ids'];
        $createdAtList = $input['created_at'];

        $alumniModel = new AlumniModel();

        $results = [
            'added' => [],
            'skipped' => []
        ];

        foreach ($userIds as $index => $userId) {
            $data = [
                'course_id' => $courseId,
                'user_id' => $userId,
                'created_at' => $createdAtList[$index]
            ];

            $result = $alumniModel->insert($data);

            if ($result) {
                $results['added'][] = $userId;
            } else {
                $results['skipped'][] = $userId;
            }
        }

        return $this->response->setJSON([
            'message' => 'Alumni processed',
            'results' => $results
        ]);
    }

    public function edit($id)
    {
        $alumniModel = new AlumniModel();
        $alumni = $alumniModel->find($id);

        if (!$alumni) {
            return redirect()->back()->with('error', 'Alumni not found.');
        }

        return view('admin/pages/alumni/edit', [
            'sessionData' => $this->sessionData,
            'alumni' => $alumni
        ]);
    }

    public function update()
    {
        $alumniModel = new AlumniModel();

        $id = $this->request->getPost('id');
        $data = $this->request->getPost(['created_at']);

        if ($alumniModel->update($id, $data)) {
            return redirect()->to('/admin/alumni')->with('success', 'Alumni updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update alumni. Please try again.');
        }
    }

    public function delete($id)
    {
        $alumniModel = new AlumniModel();

        if ($alumniModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Alumni deleted successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete alumni. Please try again.'
            ])->setStatusCode(500);
        }
    }
}
?>
