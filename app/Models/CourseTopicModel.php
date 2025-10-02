<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseTopicModel extends Model
{
    protected $table = 'course_topics';
    protected $primaryKey = 'id';

    protected $allowedFields = ['course_id', 'topic_id', 'order_no', 'always_unlocked', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'course_id' => 'required|integer',
        'topic_id' => 'required|integer',
    ];

    /**
     * Get topics for a course ordered by the relation's order_no and include completion if userId provided.
     * Returns an array of associative arrays (result array) for each topic.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getTopicsByCourse($courseId, $userId = null)
    {
        $builder = $this->db->table($this->table)
            ->select('topics.*, progress.completed_at, course_topics.order_no')
            ->join('topics', 'topics.id = course_topics.topic_id', 'left')
            ->join('progress', 'progress.topic_id = topics.id' . ($userId ? ' AND progress.user_id = ' . $this->db->escape($userId) : ''), 'left')
            ->where('course_topics.course_id', $courseId)
            ->orderBy('course_topics.order_no', 'asc');

    // Return as array of arrays to make consumer code simpler (consistent array access)
    return $builder->get()->getResultArray();
    }
}
