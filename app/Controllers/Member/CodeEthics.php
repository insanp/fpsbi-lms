<?php

namespace App\Controllers\Member;

use App\Models\TopicModel;
use App\Models\TaskModel;
use App\Models\NotesModel;
use App\Models\TaskAttemptModel;
use App\Models\MCAnswerModel;
use App\Models\OtherAnswerModel;
use App\Services\ProgressService;
use App\Services\QFCPart2AnalysisService;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Exceptions\HTTPException;

helper('curl_helper');

class CodeEthics extends \App\Controllers\BaseController
{
  private $cache;
  private $session;
  private $sessionData;
  private $courseId = 1;
  protected $assistantId = 'asst_aEEhGyqvthZIUQ7uC2v80H8u';

  public function __construct()
  {
    $this->cache = \Config\Services::cache();

    // Ensure the session library is loaded
    $this->session = session();

    // Load the UserModel or any other necessary models
    $this->sessionData = $this->session->get('user');
  }

  public function index()
  {
    $topicModel = new TopicModel();
    $topics = $topicModel->getTopicsWithCompletionStatus($this->courseId, $this->sessionData['id']);

    $progressService = new ProgressService();
    $topicAccess = $progressService->determineTopicAccess($topics);

    $topics = $topicAccess['topics'];

    // Updated: use attachQuizInfo from ProgressService
    $progressService->attachQuizInfo($topics, $this->sessionData['id']);

    $progressPercentage = $progressService->getProgressPercentage($this->courseId, $this->sessionData['id']);

    return view('member/pages/code-of-ethics/home', [
      'sessionData'        => $this->sessionData,
      'topics'             => $topics,
      'progressPercentage' => round($progressPercentage, 2),
      'accessUntil'        => $this->sessionData['active_enrollments'][$this->courseId]
    ]);
  }

  public function showTopic($relationId)
  {
    $topicModel = new TopicModel();
    $notesModel = new NotesModel();
    $userId = $this->sessionData['id'];

    // Fetch topics with completion status (includes course_topic_id)
    $topics = $topicModel->getTopicsWithCompletionStatus($this->courseId, $userId);

    $progressService = new ProgressService();
    $topicAccess = $progressService->determineTopicAccess($topics, $relationId);

    if (!$topicAccess['hasAccess']) {
      return redirect()->to('/member/code-of-ethics')->with('error', 'Anda belum bisa mengakses topik/modul ini.');
    }

    $cacheKey = "topic_detail_{$relationId}";
    $cachedData = $this->cache->get($cacheKey);

    $data = array();
    $data['sessionData'] = $this->sessionData;

    // If cached data exists, merge with sessionData
    if ($cachedData) {
      $data = array_merge($cachedData, $data);
    } else {
      // Fetch fresh data
      $topicModel = new TopicModel();

      // Resolve relationId -> topic id
      $courseTopicModel = new \App\Models\CourseTopicModel();
      $relation = $courseTopicModel->find($relationId);
      if (!$relation) throw new HttpException('Topik tidak ditemukan.', 404);

      $data['topic'] = $topicModel->find($relation['topic_id']);

      // Get topics for the course using the pivot (ordered, includes course_topic_id)
      $topics = $topicModel->getTopicsForCourse($this->courseId, $this->sessionData['id']);
      $data['total_topics'] = count($topics);

      // Determine current index based on course_topic_id
      $currentIndex = null;
      foreach ($topics as $index => $topic) {
        if ($topic['course_topic_id'] == $relationId) {
          $currentIndex = $index;
          break;
        }
      }

      $data['current_topic_number'] = is_null($currentIndex) ? 0 : ($currentIndex + 1);

      $previousTopic = null;
      $nextTopic = null;
      if (!is_null($currentIndex)) {
        if ($currentIndex > 0) $previousTopic = $topics[$currentIndex - 1];
        if ($currentIndex < count($topics) - 1) $nextTopic = $topics[$currentIndex + 1];
      }

      $data['previous_topic'] = $previousTopic;
      $data['next_topic'] = $nextTopic;

      $taskModel = new TaskModel();
      $tasks = $taskModel->where('topic_id', $data['topic']['id'])->findAll();

      foreach ($tasks as $task) {
        if ($task['type'] == 'quiz') {
          $data['task_id_quiz'] = $task['id'];
          $this->session->set('task_id_quiz', $task['id']);
        } elseif ($task['type'] == 'assignment') {
          $data['task_id_assignment'] = $task['id'];
          $this->session->set('task_id_assignment', $task['id']);
        }
      }
      $data['task_id'] = ($tasks) ? $tasks[0]['id'] : null;
      $data['topic_id'] = $data['topic']['id'];

      // Cache the new data for future use
      $this->cache->save($cacheKey, $data, 60);

      // Merge with sessionData
      $data = array_merge($data, array('sessionData' => $this->sessionData));
    }

    // Retrieve the user's note for this topic
    $note = $notesModel->where('topic_id', $data['topic']['id'])->where('user_id', $userId)->first();
    $data['note'] = $note ? $note['note'] : '';

    // store resolved topic id in session for other flows
    $this->session->set('topic_id', $data['topic']['id']);

    // load any task widget
    $data['task_widget_quiz'] = (isset($data['task_id_quiz'])) ? view('member/widgets/quiz_practice', array('task_id' => $data['task_id_quiz'], 'topic_id' => $data['topic']['id'])) : '';
    $progressService->checkAndUpdateProgress($this->sessionData, $data['topic']['id']);
    return view('member/pages/code-of-ethics/topics/' . $data['topic']['template'], $data);
  }

  public function startFA()
  {
    $requestData = $this->request->getPost();
    $topicId = $requestData['topic_id'];
    $secretKey = $this->session->get('fa_secret_key');
    if ($requestData['fa_secret_key'] !== $secretKey) {
      return redirect()->to('/member/code-of-ethics')->with('error', 'Anda belum bisa mengakses topik/modul ini.');
    }

    $userId = $this->sessionData['id'];
    $taskModel = new TaskModel();
    $taskAttemptsModel = new TaskAttemptModel();
    $progressModel = new \App\Models\ProgressModel();
    // Check if progress for this topic is already completed
    $progress = $progressModel->where('user_id', $userId)->where('topic_id', $topicId)->where('completed_at IS NOT NULL')->first();
    if ($progress) {
      return redirect()->to('/member/code-of-ethics/final-assessment/result')->with('error', 'Anda sudah menyelesaikan Assessment.');
    }

    $tasks = $taskModel->where('topic_id', $topicId)->findAll();
    if (empty($tasks)) {
      return redirect()->back()->with('error', 'No tasks found for the specified topic.');
    }
    // Only allow if attempts < max_attempts, and only create a new attempt if no incomplete attempt exists
    foreach ($tasks as $task) {
      $maxAttempts = $taskModel->getMaxAttempts($task['id']);
      $attemptCount = $taskAttemptsModel->where('user_id', $userId)->where('task_id', $task['id'])->countAllResults();
      if ($attemptCount > $maxAttempts) {
        return redirect()->to('/member/code-of-ethics/final-assessment/result')->with('error', 'Anda telah mencapai batas maksimal percobaan assessment.');
      }
      // Check for existing incomplete attempt
      $incompleteAttempt = $taskAttemptsModel->where('user_id', $userId)
        ->where('task_id', $task['id'])
        ->where('completed_at IS NULL')
        ->orderBy('created_at', 'DESC')
        ->first();
      if (!$incompleteAttempt) {
        // Only insert if no incomplete attempt exists
        $timestamp = date('Y-m-d H:i:s');
        $data = [
          'user_id'    => $userId,
          'task_id'    => $task['id'],
          'created_at' => $timestamp
        ];
        $taskAttemptsModel->insert($data);
      }
    }
    return redirect()->to('/member/code-of-ethics/final-assessment/show')->with('success', 'Percobaan assessment telah dimulai.');
  }

  public function showFA()
  {
    $courseExamModel = new \App\Models\CourseExamModel();
    $isCompleted = $courseExamModel->isExamTopicCompleted($this->courseId);

    if ($isCompleted) {
      return redirect()->to('/member/code-of-ethics/final-assessment/result')->with('error', 'Anda sudah menyelesaikan Assessment.');
    }

    $data = array();
    $data['sessionData'] = $this->sessionData;

    $secretKey = bin2hex(random_bytes(32)); // Generates a 64-character unique key
    $this->session->set('fa_secret_key', $secretKey);

    $taskAttemptsModel = new TaskAttemptModel();

    // Check if the user has any attempts for exam tasks under this course and topic
    if ($taskAttemptsModel->hasAttemptsForCourseExam($this->sessionData['id'], $this->courseId)) {
      $taskModel = new TaskModel();

      // Part 1
      $cacheKey = "exam_mc_{$this->courseId}";
      $cachedData = $this->cache->get($cacheKey);

      if ($cachedData) {
        $examMcQuestionsData = $this->cache->get($cacheKey);
      } else {
        $examMcQuestionsData = $taskModel->getExamMcTaskWithQuestionsByCourse($this->courseId);
        $this->cache->save($cacheKey, $examMcQuestionsData, 60);
      }
      $data['part1Data'] = $examMcQuestionsData;

      $currentAttempt = 0;
      $currentAttemptCreatedAt = null;

      $taskId = $examMcQuestionsData['task']['id'];
      $userId = $this->sessionData['id'];
      $currentAttempt = $taskAttemptsModel->where('user_id', $userId)->where('task_id', $taskId)->countAllResults();
      // Get the latest incomplete attempt, or latest completed if none incomplete
      $latestAttempt = $taskAttemptsModel->where('user_id', $userId)
        ->where('task_id', $taskId)
        ->orderBy('created_at', 'DESC')
        ->first();
      if ($latestAttempt) {
        $currentAttemptCreatedAt = $latestAttempt['created_at'];
      }

      $data['current_attempt'] = $currentAttempt;
      $data['current_attempt_created_at'] = $currentAttemptCreatedAt;

      $data['fa_secret_key'] = $secretKey;

      return view('member/pages/code-of-ethics/final_assessment/index', $data);
    } else {
      return redirect()->to('/member/code-of-ethics')->with('error', 'Anda belum bisa mengakses topik/modul ini.');
    }
  }

  public function submitFA()
  {
    $data = array();
    $data['sessionData'] = $this->sessionData;

    $requestData = $this->request->getPost();
    $secretKey = $this->session->get('fa_secret_key');
    if ($requestData['fa_secret_key'] !== $secretKey) {
      return redirect()->to('/member/code-of-ethics')->with('error', 'Anda belum bisa mengakses topik/modul ini.');
    }

    // check Part 1
    $taskModel = new TaskModel();
    $examMcQuestionsData = $taskModel->getExamMcTaskWithQuestionsByCourse($this->courseId);
    $submitted_answers = $requestData['part1'];
    $questions = $examMcQuestionsData['questions'];
    $results = [];

    $part1Correct = 0;
    $part1TotalQuestions = 0;

    foreach ($questions as $question) {
      $part1TotalQuestions++;
      $question_id = $question['id'];
      $correct_option_id = null;

      // Find the correct option id
      foreach ($question['options'] as $option) {
        if ($option['is_correct'] == 1) {
          $correct_option_id = $option['id'];
          break;
        }
      }

      // Check if the answer was submitted and whether it is correct
      if (isset($submitted_answers[$question_id])) {
        $submitted_option_id = $submitted_answers[$question_id];
        $is_correct = ($submitted_option_id == $correct_option_id);
        if ($is_correct) $part1Correct++;

        $results[$question_id] = [
          'submitted_option' => $submitted_option_id,
          'correct_option' => $correct_option_id,
          'is_correct' => $is_correct,
          'status' => 'answered'
        ];
      } else {
        // If no answer was submitted
        $results[$question_id] = [
          'submitted_option' => null,
          'correct_option' => $correct_option_id,
          'is_correct' => false,
          'status' => 'unanswered',
        ];
      }
    }

    $part1Score = 100.0 * $part1Correct / $part1TotalQuestions;
    $data['part1'] = array(
      'score' => $part1Score,
      'results' => $results
    );

    // Use the latest incomplete attempt for this user and task
    $taskAttemptModel = new TaskAttemptModel();
    $taskId = $requestData['part1_taskid'];
    $userId = $this->sessionData['id'];
    $timestamp = date('Y-m-d H:i:s');
    $latestAttempt = $taskAttemptModel->where('user_id', $userId)
      ->where('task_id', $taskId)
      ->where('completed_at IS NULL')
      ->orderBy('created_at', 'DESC')
      ->first();
    if ($latestAttempt) {
      // Update score for this attempt
      $taskAttemptId = $latestAttempt['id'];
      $taskAttemptModel->update($taskAttemptId, ['score' => $part1Score]);
    } else {
      // Fallback: create a new attempt if none found (should not happen in normal flow)
      $attemptData = [
        'user_id' => $userId,
        'task_id' => $taskId,
        'created_at' => $timestamp,
        'score' => $part1Score
      ];
      $taskAttemptId = $taskAttemptModel->insert($attemptData, true);
    }
    // Always mark as completed regardless of score
    $taskAttemptModel->markAsCompletedByAttemptId($taskAttemptId, $part1Score);

    $insertData = [];
    $timestamp = date('Y-m-d H:i:s');

    foreach ($submitted_answers as $questionId => $selectedOptionId) {
      $insertData[] = [
        'question_id'        => $questionId,
        'selected_option_id' => $selectedOptionId,
        'task_attempt_id'    => $taskAttemptId,
        'answered_at'        => $timestamp
      ];
    }

    // Insert all answers in a single batch
    $mcAnswersModel = new MCAnswerModel();
    $mcAnswersModel->insertBatchUpdateOnDuplicate($insertData);

    // notify admin that this user finishes the final assessment
    $this->sendEmailLatihanUjian();

    return view('member/pages/code-of-ethics/final_assessment/submission', $data);
  }

  public function resultFA()
  {
    $data = array();
    $data['sessionData'] = $this->sessionData;

    // Summary Part 1
    $taskModel = new TaskModel();
    $mcAnswerModel = new MCAnswerModel();
    $taskAttemptModel = new TaskAttemptModel();

    $taskId = $taskModel->getTaskIdByCourse($this->courseId, 'exam_mc')[0]['id'];
    $userId = $this->sessionData['id'];
    // Get all attempts for this user and task, latest first
    $allAttempts = $taskAttemptModel->where('user_id', $userId)->where('task_id', $taskId)->orderBy('created_at', 'DESC')->findAll();
    $latestAttempt = $allAttempts ? $allAttempts[0] : null;
    $taskAttemptId = $latestAttempt ? $latestAttempt['id'] : null;
    // Find the attempt number (1-based, latest = highest)
    $attemptNumber = $allAttempts ? count($allAttempts) : 0;
    $attemptCreatedAt = $latestAttempt ? $latestAttempt['created_at'] : null;
    $attemptCompletedAt = $latestAttempt ? $latestAttempt['completed_at'] : null;

    // Fetch questions for the Part 1 exam
    $examMcQuestionsData = $taskModel->getExamMcTaskWithQuestionsByCourse($this->courseId);
    $questions = $examMcQuestionsData['questions'];

    // Fetch submitted answers from mc_answers table
    $submittedAnswers = $taskAttemptId ? $mcAnswerModel->getAnswersByTaskAttemptId($taskAttemptId) : [];
    $results = [];

    $part1Correct = 0;
    $part1TotalQuestions = 0;

    foreach ($questions as $question) {
      $part1TotalQuestions++;
      $question_id = $question['id'];
      $correct_option_id = null;
      foreach ($question['options'] as $option) {
        if ($option['is_correct'] == 1) {
          $correct_option_id = $option['id'];
          break;
        }
      }
      if (isset($submittedAnswers[$question_id])) {
        $submitted_option_id = $submittedAnswers[$question_id];
        $is_correct = ($submitted_option_id == $correct_option_id);
        if ($is_correct) $part1Correct++;
        $results[$question_id] = [
          'submitted_option' => $submitted_option_id,
          'correct_option' => $correct_option_id,
          'is_correct' => $is_correct,
          'status' => 'answered'
        ];
      } else {
        $results[$question_id] = [
          'submitted_option' => null,
          'correct_option' => $correct_option_id,
          'is_correct' => false,
          'status' => 'unanswered',
        ];
      }
    }
    $part1Score = $part1TotalQuestions > 0 ? 100.0 * $part1Correct / $part1TotalQuestions : 0;
    // Get max attempts and current attempt count
    $maxAttempts = $taskModel->getMaxAttempts($taskId);
    $attemptCount = $taskAttemptModel->where('user_id', $userId)->where('task_id', $taskId)->countAllResults();
    $data['part1'] = [
      'score' => $part1Score,
      'correct_answers' => $part1Correct,
      'total_questions' => $part1TotalQuestions,
      'results' => $results,
      'max_attempts' => $maxAttempts,
      'attempt_count' => $attemptCount,
      'attempt_number' => $attemptNumber,
      'attempt_created_at' => $attemptCreatedAt,
      'attempt_completed_at' => $attemptCompletedAt
    ];
    $data['part1Data'] = $examMcQuestionsData;

    // refresh progress
    $progressService = new ProgressService();
    $progressService->checkAndUpdateProgress($this->sessionData, $data['part1Data']['task']['topic_id']);
    return view('member/pages/code-of-ethics/final_assessment/result', $data);
  }

  public function analyzePart2()
  {
    try {
      // Step 1: Retrieve task attempt ID from the session
      $taskAttemptId = $this->session->get('part2_task_attempt_id');
      if (!$taskAttemptId) {
        return $this->response->setJSON(['error' => 'Task attempt ID not found in session'])->setStatusCode(400);
      }

      // Step 2: Call the service
      $qfcPart2AnalysisService = new QFCPart2AnalysisService();
      $result = $qfcPart2AnalysisService->analyze($taskAttemptId);

      // Return JSON response
      return $this->response->setJSON($result);
    } catch (\Exception $e) {
      return $this->response->setJSON(['error' => $e->getMessage()])->setStatusCode(500);
    }
  }

  public function sendEmailLatihanUjian()
  {
    $email = \Config\Services::email();

    $report = array(
      'member_id' => $this->sessionData['member_id'],
      'name' => $this->sessionData['name'],
      'email' => $this->sessionData['email'],
      'program' => 'Kode Etik dan Rules of Conduct'
    );
    $htmlReport = view('emails/user_finish', ['report' => $report]);;

    $email->setTo(array('insan.putranda@fpsbindonesia.net')); // Admin email
    $email->setSubject('FPSB LMS - User Selesai Kode Etik dan Rules of Conduct');
    $email->setMessage($htmlReport); // HTML content
    $email->setMailType('html');
    $email->send();
  }
}
