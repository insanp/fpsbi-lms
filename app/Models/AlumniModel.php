<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table = 'alumni';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'course_id', 'created_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    protected $allowCallbacks = true;

    protected $validationRules = [
        'id' => 'permit_empty',
        'user_id' => 'required',
        'course_id' => 'required',
    ];

    protected $validationMessages = [
        'user_id' => [
            'is_unique' => 'The combination of user_id and course_id must be unique.'
        ],
        'course_id' => [
            'is_unique' => 'The combination of user_id and course_id must be unique.'
        ]
    ];

    protected $skipValidation = false;

    protected $uniqueFields = ['user_id', 'course_id'];

    public function getAlumniWithUser($limit, $offset, $search = null, $courseId = null)
    {
        return $this->select('alumni.*, alumni.id AS alumni_id, alumni.created_at AS alumnus_date, users.*, courses.name AS course_name')
            ->join('users', 'users.id = alumni.user_id', 'left')
            ->join('courses', 'courses.id = alumni.course_id', 'left')
            ->applySearchCondition($search)
            ->applyCourseFilter($courseId)
            ->limit($limit, $offset)
            ->get()
            ->getResultArray();
    }

    public function getTotalAlumni($search = null, $courseId = null)
    {
        $this->join('users', 'users.id = alumni.user_id', 'left');
        $this->applySearchCondition($search);
        $this->applyCourseFilter($courseId);
        return $this->countAllResults();
    }

    private function applySearchCondition($search)
    {
        if ($search) {
            $this->groupStart()
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
            $this->where('alumni.course_id', $courseId);
        }
        return $this;
    }

    // Additional methods for AlumniModel can be added here
}
?>
