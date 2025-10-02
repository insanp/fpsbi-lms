<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TaskModel;
use App\Models\QuestionModel;
use App\Models\MCOptionModel;

class TaskAndQuestionModel extends Model
{
    protected $table = 'tasks_and_questions';
    protected $primaryKey = 'id';

    protected $allowedFields = ['task_id', 'question_id', 'order_num'];

    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'task_id' => 'required',
        'question_id' => 'required',
        'order_num' => 'required'
    ];

    protected $validationMessages = [];

    protected $beforeInsert = [];
    private $cache;

    public function loadTaskAndQuestions($taskId, $withCache = true)
    {
        $this->cache = \Config\Services::cache();
        $cacheKey = "model_{$this->table}_loadTaskAndQuestions_{$taskId}";
        $cachedData = $this->cache->get($cacheKey);

        if ($cachedData && $withCache) {
            return $cachedData;
        }

        $taskModel = new TaskModel();
        $task = $taskModel->find($taskId);

        $taskAndQuestions = $this->where('task_id', $taskId)
            ->orderBy('order_num', 'ASC')
            ->findAll();

        $questionIds = array_column($taskAndQuestions, 'question_id');

        if (empty($questionIds)) {
            return null;
        }

        $questionModel = new QuestionModel();
        $questions = $questionModel->whereIn('id', $questionIds)->findAll();

        $mcoModel = new MCOptionModel();

        foreach ($questions as &$question) {
            $question['order_num'] = $taskAndQuestions[array_search($question['id'], $questionIds)]['order_num'];
            $mcOptions = $mcoModel->select('id, option_text, is_correct')->where('question_id', $question['id'])->findAll();
            $question['options'] = $mcOptions;
        }

        // Sort questions by order_num
        usort($questions, function ($a, $b) {
            return $a['order_num'] <=> $b['order_num'];
        });

        $returnData = array(
            'task' => $task,
            'questions' => $questions
        );

        $this->cache->save($cacheKey, $returnData, 60);

        return $returnData;
    }
}
