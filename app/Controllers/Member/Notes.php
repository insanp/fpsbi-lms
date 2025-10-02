<?php

namespace App\Controllers\Member;

use App\Models\NotesModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;

class Notes extends \App\Controllers\BaseController
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

    public function save()
    {
        $notesModel = new NotesModel();
        $requestData = $this->request->getJSON();

        $data = [
            'topic_id' => $requestData->topic_id,
            'note' => $requestData->note,
            'user_id' => $this->sessionData['id'],
        ];

        // Check if a record already exists
        $existingNote = $notesModel->where('topic_id', $data['topic_id'])
            ->where('user_id', $data['user_id'])
            ->first();

        if ($existingNote) {
            // Update the existing record
            $data['id'] = $existingNote['id']; // Ensure the primary key is set for update
            $notesModel->save($data);
        } else {
            // Insert a new record
            $notesModel->insert($data);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Catatan berhasil disimpan.']);
    }

    public function listNotes()
    {
        $notesModel = new NotesModel();
        $courseEnrollmentModel = new \App\Models\CourseEnrollmentModel();
        $courseId = $this->request->getGet('course_id');

        $topicsModel = new \App\Models\TopicModel();

        // Fetch courses the member is enrolled in
        $courses = $courseEnrollmentModel
            ->select('courses.id, courses.name')
            ->join('courses', 'courses.id = course_enrollment.course_id')
            ->where('course_enrollment.user_id', $this->sessionData['id'])
            ->findAll();
        // Fetch topics and notes based on the selected course using the pivot (includes course_topics.order_no)
        $topics = $topicsModel->getTopicsForCourse($courseId, $this->sessionData['id']);
        $notes = $notesModel->where('user_id', $this->sessionData['id'])->findAll();

        // Map notes to topics
        foreach ($topics as &$topic) {
            $topic['notes'] = array_filter($notes, function ($note) use ($topic) {
                return $note['topic_id'] == $topic['id'];
            });
        }

        return view('member/pages/notes_list', [
            'courses' => $courses,
            'topics' => $topics,
            'selectedCourseId' => $courseId,
            'sessionData' => $this->sessionData
        ]);
    }
}
