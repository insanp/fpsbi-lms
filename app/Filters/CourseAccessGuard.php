<?php
// App/Filters/CourseAccessGuard.php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Services\CourseEnrollmentService;

class CourseAccessGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $sessionData = $session->get('user');

        // Check if user is logged in
        if (empty($sessionData)) {
            return redirect()->to('/login');
        }

        // Determine course ID based on URI segment
        $uri = $request->uri->getSegment(2); // Get the second segment of the URI
        $courseId = ($uri === 'rfp-ins') ? COURSE_RFP_INSURANCE : null;

        if ($courseId === null) {
            return redirect()->to('/member/no-access');
        }

        // Check if user has an active enrollment for the given course
        $userId = $sessionData['id'];
        $currentDate = date('Y-m-d H:i:s');

        // Use the new service for active enrollment check
        $enrollmentService = new CourseEnrollmentService();
        $activeEnrollments = $enrollmentService->getActiveEnrollments($userId, $currentDate);

        // If no active enrollment, deny access
        $sessionData['active_enrollments'] = array_column($activeEnrollments, 'access_until', 'course_id');
        $session->set('user', $sessionData);

        // Check if user has access to the requested course
        if (!array_key_exists($courseId, $sessionData['active_enrollments'])) {
            return redirect()->to('/member/no-access'); // or another page for "no access" information
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No actions needed after the request
    }
}
?>
