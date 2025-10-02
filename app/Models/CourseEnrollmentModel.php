<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseEnrollmentModel extends Model
{
    protected $table = 'course_enrollment';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'course_id', 'enrolled_at', 'access_until'];

    // Validation rules for user registration
    protected $validationRules = [
        'id' => 'permit_empty',
        'user_id' => 'required',
        'course_id' => 'required',
        'enrolled_at' => 'required',
        'access_until' => 'required'
    ];

    private function applySearchCondition($search)
    {
        if ($search) {
            $this->groupStart() // Group conditions for proper OR handling
                ->like('users.name', $search)
                ->orLike('users.email', $search)
                ->orLike('users.member_id', $search)
            ->groupEnd();
        }
        return $this;
    }

    private function applyCourseFilter($courseId)
    {
        if ($courseId) {
            $this->where('course_enrollment.course_id', $courseId);
        }
        return $this;
    }

    public function getEnrollmentsWithUser($limit, $offset, $search = null, $courseId = null)
    {
        return $this->select('course_enrollment.*, course_enrollment.id AS enroll_id, users.*, courses.name AS course_name')
            ->join('users', 'users.id = course_enrollment.user_id', 'left')
            ->join('courses', 'courses.id = course_enrollment.course_id', 'left')
            ->applySearchCondition($search)
            ->applyCourseFilter($courseId)
            ->limit($limit, $offset)
            ->get()
            ->getResultArray();
    }

    public function getTotalEnrollments($search = null, $courseId = null)
    {
        $this->join('users', 'users.id = course_enrollment.user_id', 'left');
        $this->applySearchCondition($search);
        $this->applyCourseFilter($courseId);
        return $this->countAllResults();
    }

    public function insertIfAccessExpired($data)
    {
        // Check if there is an active enrollment for the same user and course
        $exists = $this->where('course_id', $data['course_id'])
            ->where('user_id', $data['user_id'])
            ->where('access_until >', date('Y-m-d H:i:s')) // Check if access_until is in the future
            ->first();

        // If no active enrollment exists, insert the new enrollment
        if (!$exists) {
            return $this->insert($data);
        }

        return false; // No insertion, active enrollment exists
    }
}
?>
