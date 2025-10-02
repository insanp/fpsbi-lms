<?php

namespace App\Services;

use App\Models\CourseEnrollmentModel;
use App\Models\CourseModel;
use App\Models\UserModel;
use App\Services\ProgressService;

class CronJobService
{
    protected $enrollmentModel;
    protected $userModel;
    protected $courseModel;
    protected $progressService;

    public function __construct()
    {
        $this->enrollmentModel = new CourseEnrollmentModel();
        $this->userModel = new UserModel();
        $this->courseModel = new CourseModel();
        $this->progressService = new ProgressService();
    }

    public function generateUserProgressReport()
    {
        // Step 1: Get active enrollments
        $activeEnrollments = $this->enrollmentModel
            ->select('course_enrollment.user_id, course_enrollment.course_id, users.name as user_name, users.email as user_email, courses.name as course_name')
            ->join('users', 'course_enrollment.user_id = users.id')
            ->join('courses', 'course_enrollment.course_id = courses.id')
            ->where('course_enrollment.access_until >=', date('Y-m-d H:i:s')) // Active enrollment
            ->findAll();

        // Step 2: Calculate progress for each enrollment
        $report = [];
        foreach ($activeEnrollments as $enrollment) {
            $progressPercentage = $this->progressService->getProgressPercentage($enrollment['course_id'], $enrollment['user_id']);

            $report[] = [
                'user_name' => $enrollment['user_name'],
                'user_email' => $enrollment['user_email'],
                'course_name' => $enrollment['course_name'],
                'progress_percentage' => round($progressPercentage, 2),
            ];
        }

        // Step 3: Return the compiled report
        return $report;
    }

    public function generateUserProgressReportHTML()
    {
        // Step 1: Get active enrollments
        $activeEnrollments = $this->enrollmentModel
            ->select('course_enrollment.user_id, course_enrollment.course_id, course_enrollment.enrolled_at, course_enrollment.access_until, users.member_id as user_member_id, users.name as user_name, users.email as user_email, courses.name as course_name')
            ->join('users', 'course_enrollment.user_id = users.id')
            ->join('courses', 'course_enrollment.course_id = courses.id')
            ->where('course_enrollment.access_until >=', date('Y-m-d H:i:s')) // Active enrollment
            ->orderBy('users.name', 'ASC') // Order by user name in ascending order
            ->findAll();

        // Step 2: Check if there are no active enrollments
        if (empty($activeEnrollments)) {
            return null;
        }

        // Step 3: Calculate progress for each enrollment
        $report = [];
        foreach ($activeEnrollments as $enrollment) {
            $progressPercentage = $this->progressService->getProgressPercentage($enrollment['course_id'], $enrollment['user_id']);

            $report[] = [
                'user_member_id' => $enrollment['user_member_id'],
                'user_name' => $enrollment['user_name'],
                'user_email' => $enrollment['user_email'],
                'course_name' => $enrollment['course_name'],
                'enrolled_at' => $enrollment['enrolled_at'],
                'access_until' => $enrollment['access_until'],
                'progress_percentage' => round($progressPercentage, 2),
            ];
        }

        // Step 4: Render the HTML using a view
        return view('emails/user_progress_report', ['report' => $report]);
    }
}
