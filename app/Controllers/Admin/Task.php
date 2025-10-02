<?php

namespace App\Controllers\Admin;

use App\Models\TaskModel;
use App\Models\TopicModel;
use CodeIgniter\Controller;

class Task extends \App\Controllers\BaseController
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

    public function create($topicId)
    {
        $topicModel = new TopicModel();
        $topic = $topicModel->find($topicId);

        return view('admin/pages/tasks/create', [
            'sessionData' => $this->sessionData,
            'topic' => $topic
        ]);
    }

    public function store()
    {
        $taskModel = new TaskModel();
        $data = $this->request->getPost();

        // Validate the input data
        $validation = \Config\Services::validation();
        $validation->setRules($taskModel->getValidationRules(), $taskModel->getValidationMessages());

        if ($validation->run($data) === false) {
            return redirect()->to('/admin/tasks/create/' . $data['topic_id'])->withInput()->with('validation_errors', $validation->getErrors());
        }

        if ($taskModel->insert($data)) {
            return redirect()->to('/admin/topics/' . $data['topic_id'])->with('success', 'Task created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create task. Please try again.');
        }
    }

    public function edit($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        return view('admin/pages/tasks/edit', [
            'sessionData' => $this->sessionData,
            'task' => $task
        ]);
    }

    public function update()
    {
        $taskModel = new TaskModel();
        $data = $this->request->getPost();
        $id = $data['id'];

        // Validate the input data
        $validation = \Config\Services::validation();
        $validation->setRules($taskModel->getValidationRules(), $taskModel->getValidationMessages());

        if ($validation->run($data) === false) {
            return redirect()->to('/admin/tasks/' . $id . '/edit')->withInput()->with('validation_errors', $validation->getErrors());
        }

        if ($taskModel->update($id, $data)) {
            return redirect()->to('/admin/topics/' . $data['topic_id'])->with('success', 'Task updated successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to update task. Please try again.');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if ($taskModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Task deleted successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete task. Please try again.'
            ])->setStatusCode(500);
        }
    }

    public function show($id)
    {
        $taskModel = new TaskModel();
        $taskAndQuestionModel = new \App\Models\TaskAndQuestionModel();
        $task = $taskModel->find($id);

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        $taskWithQuestions = $taskAndQuestionModel->loadTaskAndQuestions($id, false);

        return view('admin/pages/tasks/show', [
            'sessionData' => $this->sessionData,
            'task' => $task,
            'questions' => $taskWithQuestions ? $taskWithQuestions['questions'] : []
        ]);
    }

    public function updateQuestions()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $taskModel = new TaskModel();
        $questionModel = new \App\Models\QuestionModel();
        $mcOptionModel = new \App\Models\MCOptionModel();
        $taskAndQuestionModel = new \App\Models\TaskAndQuestionModel();
        $data = $this->request->getPost();

        $orderNum = 1;
        foreach ($data['questions'] as $questionId => $questionData) {
            if (strpos($questionId, 'new_') === 0) {
                // Validate new question data using model's validation rules
                if (!$questionModel->validate($questionData)) {
                    $validationErrors = $questionModel->errors();
                    return redirect()->to('/admin/tasks/' . $data['task_id'])->withInput()->with('validation_errors', $validationErrors);
                }

                // Insert new question
                $questionId = $questionModel->insert([
                    'question' => $questionData['question'],
                    'image' => $questionData['image'] ?? null,
                    'correct_feedback' => $questionData['correct_feedback'],
                    'incorrect_feedback' => $questionData['incorrect_feedback']
                ], true);

                // Insert new task and question relation
                $taskAndQuestionModel->insert([
                    'task_id' => $data['task_id'],
                    'question_id' => $questionId,
                    'order_num' => $orderNum++
                ]);

                // Insert new options
                if (!empty($questionData['options'])) {
                    foreach ($questionData['options'] as $optionData) {
                        $mcOptionModel->insert([
                            'question_id' => $questionId,
                            'option_text' => $optionData['option_text'],
                            'is_correct' => isset($optionData['is_correct']) ? 1 : 0
                        ]);
                    }
                }
            } else {
                // Update existing question
                $questionModel->update($questionId, [
                    'question' => $questionData['question'],
                    'image' => $questionData['image'] ?? null,
                    'correct_feedback' => $questionData['correct_feedback'],
                    'incorrect_feedback' => $questionData['incorrect_feedback']
                ]);

                // Update existing task and question relation using both task_id and question_id
                $taskAndQuestionModel
                    ->where('task_id', $data['task_id'])
                    ->where('question_id', $questionId)
                    ->set(['order_num' => $orderNum++])
                    ->update();

                // Update existing options
                if (!empty($questionData['options'])) {
                    foreach ($questionData['options'] as $optionId => $optionData) {
                        $mcOptionModel->update($optionId, [
                            'option_text' => $optionData['option_text'],
                            'is_correct' => isset($optionData['is_correct']) ? 1 : 0
                        ]);
                    }
                }
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            $error = $db->error();
            return redirect()->to('/admin/tasks/' . $data['task_id'])->with('error', 'Failed to update questions. Error: ' . $error['message']);
        }

        return redirect()->to('/admin/tasks/' . $data['task_id'])->with('success', 'Questions updated successfully.');
    }
}
?>
