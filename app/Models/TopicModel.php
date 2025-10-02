<?php

namespace App\Models;

use CodeIgniter\Model;

class TopicModel extends Model
{
    protected $table = 'topics';
    protected $primaryKey = 'id';

    // topics are now reusable across courses; ordering is stored in the course_topics relation
    protected $allowedFields = ['title', 'resume', 'cover_img', 'template', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'title' => 'required|min_length[3]|max_length[100]',
        'resume' => 'required|min_length[10]|max_length[255]',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'The title field is required.',
            'min_length' => 'The title must be at least 3 characters long.',
            'max_length' => 'The title cannot exceed 100 characters.',
        ],
        'resume' => [
            'required' => 'The resume field is required.',
            'min_length' => 'The resume must be at least 10 characters long.',
            'max_length' => 'The resume cannot exceed 255 characters.',
        ]
    ];

    protected $beforeInsert = [];

    public function getTopicsWithCompletionStatus($courseId, $userId)
    {
        // keep a compatibility helper: fetch topics that are linked to the course and include completion
    return $this->select("topics.*, progress.completed_at, course_topics.order_no, course_topics.always_unlocked, course_topics.id AS course_topic_id")
            ->join('course_topics', 'course_topics.topic_id = topics.id', 'inner')
            ->join('progress', 'progress.topic_id = topics.id AND progress.user_id = ' . $userId, 'left')
            ->where('course_topics.course_id', $courseId)
            ->orderBy('course_topics.order_no', 'asc')
            ->findAll();
    }

    /**
     * Get topics for a course via the course_topics pivot, ordered by the pivot.order_no.
     * Returns array of results.
     */
    public function getTopicsForCourse($courseId, $userId = null)
    {
        $builder = $this->db->table($this->table)
            ->select('topics.*, progress.completed_at, course_topics.order_no, course_topics.id AS course_topic_id')
            ->join('course_topics', 'course_topics.topic_id = topics.id', 'inner')
            ->join('progress', 'progress.topic_id = topics.id' . ($userId ? ' AND progress.user_id = ' . $this->db->escape($userId) : ''), 'left')
            ->where('course_topics.course_id', $courseId)
            ->orderBy('course_topics.order_no', 'asc');

        return $builder->get()->getResultArray();
    }

    public function getTopicsWithFilters($limit, $offset, $searchTerm = null, $courseId = null)
    {
        $builder = $this->db->table($this->table)
            ->limit($limit, $offset);

        if ($courseId) {
            // when filtering by course, join the pivot to order by the relation.order_no and get course name
            $builder->select('topics.*, courses.name as course_name, course_topics.order_no')
                ->join('course_topics', 'course_topics.topic_id = topics.id', 'inner')
                ->join('courses', 'courses.id = course_topics.course_id', 'left')
                ->where('course_topics.course_id', $courseId)
                ->orderBy('course_topics.order_no', 'asc');
        } else {
            // no course specified: return topics without a course-specific order
            $builder->select('topics.*, NULL as course_name')
                ->orderBy('topics.created_at', 'asc');
        }

        if ($searchTerm) {
            $builder->like('topics.title', $searchTerm);
        }

        // if $courseId provided the where was already applied above via the pivot join

        return $builder->get()->getResultArray();
    }

    public function getTotalTopics($searchTerm = null, $courseId = null)
    {
        if ($courseId) {
            // count via pivot
            $builder = $this->db->table($this->table)
                ->join('course_topics', 'course_topics.topic_id = topics.id', 'inner')
                ->where('course_topics.course_id', $courseId);

            if ($searchTerm) {
                $builder->like('topics.title', $searchTerm);
            }

            return $builder->countAllResults();
        }

        $builder = $this->db->table($this->table);

        if ($searchTerm) {
            $builder->like('title', $searchTerm);
        }

        return $builder->countAllResults();
    }
}
