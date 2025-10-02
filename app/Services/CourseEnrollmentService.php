<?php
namespace App\Services;

use App\Models\CourseEnrollmentModel;

class CourseEnrollmentService {

    protected $courseEnrollmentModel;

    public function __construct() {
        $this->courseEnrollmentModel = new CourseEnrollmentModel();
    }

    public function getActiveEnrollments(int $userId, string $currentDate = "") {
        $currentDate = $currentDate ?? date('Y-m-d H:i:s');
        return $this->courseEnrollmentModel
            ->select('course_id, access_until')
            ->where('user_id', $userId)
            ->where('enrolled_at <=', $currentDate)
            ->where('access_until >=', $currentDate)
            ->findAll();
    }
}
