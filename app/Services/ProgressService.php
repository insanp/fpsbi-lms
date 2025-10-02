<?php
// app/Services/ProgressService.php

namespace App\Services;

use App\Models\TopicModel;
use App\Models\ProgressModel;
use App\Models\CourseEnrollmentModel;
use App\Models\TaskModel;
use App\Models\TaskAttemptModel;

class ProgressService
{
    protected $courseEnrollmentModel;
    protected $topicModel;
    protected $taskModel;
    protected $taskAttemptModel;
    protected $progressModel;

    public function __construct()
    {
        $this->courseEnrollmentModel = new CourseEnrollmentModel();
        $this->topicModel = new TopicModel();
        $this->taskModel = new TaskModel();
        $this->taskAttemptModel = new TaskAttemptModel();
        $this->progressModel = new ProgressModel();
    }

    public function getProgressPercentage($courseId, $userId)
    {
        // Count total topics in the course via the pivot
        $totalTopics = $this->topicModel->getTopicsForCourse($courseId, $userId);
        $totalCount = is_array($totalTopics) ? count($totalTopics) : 0;

        // Count completed topics by the user for this course
        $completedTopics = $this->progressModel
            ->join('topics', 'progress.topic_id = topics.id')
            ->join('course_topics', 'course_topics.topic_id = topics.id')
            ->where('course_topics.course_id', $courseId)
            ->where('progress.user_id', $userId)
            ->where('progress.completed_at IS NOT NULL')
            ->countAllResults();

        // Calculate progress percentage
        $progressPercentage = ($totalCount > 0) ? ($completedTopics / $totalCount) * 100 : 0;

        return $progressPercentage;
    }

    public function getDetailedProgress($courseId, $userId)
    {
        // Step 1: Get all topics for the course using the pivot (ordered by course_topics.order_no)
        $topics = $this->topicModel->getTopicsForCourse($courseId, $userId);

        // Step 2: Get the user's completed topics for this course
        $completedTopics = $this->progressModel
            ->where('user_id', $userId)
            ->where('completed_at IS NOT NULL')
            ->findColumn('topic_id') ?? [];

        // Step 3: Prepare topic details with completion status
        $topicDetails = [];
        foreach ($topics as $topic) {
            $topicDetails[] = [
                'id' => $topic['id'],
                'title' => $topic['title'],
                'is_completed' => in_array($topic['id'], $completedTopics), // true if topic ID is in completed list
                'completed_at' => in_array($topic['id'], $completedTopics) ?
                    $this->progressModel
                    ->where('user_id', $userId)
                    ->where('topic_id', $topic['id'])
                    ->get()
                    ->getRow()
                    ->completed_at : null // fetch the actual completion timestamp if completed
            ];
        }

        return $topicDetails;
    }

    public function checkAndUpdateProgress($userData, $topicId, $skipNoTask = false)
    {
        $progressModel = new ProgressModel();
        $progressModel->checkAndInsertProgress($userData['id'], $topicId, $skipNoTask);
    }

    public function determineTopicAccess($topics, $requestedTopicId = null)
    {
        $firstUncompletedFound = false;
        $hasAccess = false;

        foreach ($topics as &$topic) {
            // If the topic is already completed, keep it completed.
            if ($topic['completed_at'] !== null) {
                $topic['access'] = 'completed';
                if ($topic['course_topic_id'] === $requestedTopicId) {
                    $hasAccess = true;
                }
                continue;
            }

            // For non-completed topics: if always_unlocked is true, unlock it
            // but do NOT consume the first-uncompleted slot.
            if (!empty($topic['always_unlocked'])) {
                $topic['access'] = 'unlocked';
                $firstUncompletedFound = true;
                if ($topic['course_topic_id'] === $requestedTopicId) {
                    $hasAccess = true;
                }
                continue;
            }

            // First non-completed, non-always-unlocked topic becomes unlocked.
            if ($topic['completed_at'] === null && !$firstUncompletedFound) {
                $topic['access'] = 'unlocked';
                $firstUncompletedFound = true;
                if ($topic['course_topic_id'] === $requestedTopicId) {
                    $hasAccess = true;
                }
            } else {
                // The rest remain locked
                $topic['access'] = 'locked';
            }
        }

        // Return topics with their access status and the access flag
        return [
            'topics' => $topics,
            'hasAccess' => $requestedTopicId ? $hasAccess : null,
        ];
    }

    public function showUserProgress($userId, $courseId)
    {
        // Step 1: Check if the user is enrolled in the course
        $enrollment = $this->courseEnrollmentModel
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if (!$enrollment) {
            throw new \Exception("User is not enrolled in this course.");
        }

        // Step 2: Fetch topics and tasks for the course
        $topics = $this->topicModel->getTopicsForCourse($courseId, $userId);
        $topicIds = array_column($topics, 'id');

        $tasks = $this->taskModel->whereIn('topic_id', $topicIds)->findAll();
        $taskIds = array_column($tasks, 'id');

        // Step 3: Fetch user's completed topics and tasks
        $completedTopics = $this->progressModel
            ->where('user_id', $userId)
            ->whereIn('topic_id', $topicIds)
            ->where('completed_at IS NOT NULL', null, false)
            ->findColumn('topic_id');

        $completedTasks = $this->taskAttemptModel
            ->where('user_id', $userId)
            ->whereIn('task_id', $taskIds)
            ->where('completed_at IS NOT NULL', null, false)
            ->findColumn('task_id');

        // Step 4: Calculate progress
        $totalTopics = count($topics);
        $completedTopicCount = count($completedTopics);
        $topicProgress = $totalTopics > 0 ? ($completedTopicCount / $totalTopics) * 100 : 0;

        $totalTasks = count($tasks);
        $completedTaskCount = count($completedTasks);
        $taskProgress = $totalTasks > 0 ? ($completedTaskCount / $totalTasks) * 100 : 0;

        // Step 5: Build response
        return [
            'course_id' => $courseId,
            'user_id' => $userId,
            'enrollment' => $enrollment,
            'topics' => $topics,
            'tasks' => $tasks,
            'completed_topics' => $completedTopics,
            'completed_tasks' => $completedTasks,
            'topic_progress' => $topicProgress,
            'task_progress' => $taskProgress,
        ];
    }

    public function attachQuizInfo(&$topics, $userId)
    {
        $taskModel = new TaskModel();
        $taskAttemptModel = new TaskAttemptModel();

        // Fetch all quiz tasks and their attempts in a single query
        $quizData = $taskModel->select('tasks.topic_id, tasks.name, tasks.id as task_id, task_attempts.score, task_attempts.completed_at')
            ->join('task_attempts', 'tasks.id = task_attempts.task_id AND task_attempts.user_id = ' . $userId, 'left')
            ->where('tasks.type', 'quiz')
            ->whereIn('tasks.topic_id', array_column($topics, 'id'))
            ->findAll();

        // Group quiz data by topic_id for easier access
        $quizDataByTopic = [];
        foreach ($quizData as $quiz) {
            $quizDataByTopic[$quiz['topic_id']] = $quiz; // Store only one quiz per topic
        }

        // Attach quiz info to topics
        foreach ($topics as &$topic) {
            if (isset($quizDataByTopic[$topic['id']])) {
                $quiz = $quizDataByTopic[$topic['id']];
                $quizInfo = [
                    'task_id'    => $quiz['task_id'],
                    'name'       => $quiz['name'],
                    'quiz_stars' => null
                ];

                if ($quiz['completed_at']) {
                    $score = $quiz['score'];
                    $quizInfo['quiz_stars'] = $score == 100 ? 3 : ($score >= 50 ? 2 : 1);
                }

                $topic['quiz'] = $quizInfo; // Attach single quiz info
            } else {
                $topic['quiz'] = null; // No quiz for this topic
            }
        }
    }
}
