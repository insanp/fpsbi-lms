<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Services\CronJobService;

class GenerateUserProgressReport extends BaseCommand
{
    protected $group       = 'CronJobs';
    protected $name        = 'generate:progress-report';
    protected $description = 'Generates a progress report for users with active enrollments.';

    public function run(array $params)
    {
        $cronJobService = new CronJobService();
        $email = \Config\Services::email();

        $htmlReport = $cronJobService->generateUserProgressReportHTML();

        // Check if there is no progress report to send
        if ($htmlReport === null) {
            CLI::write("No active enrollments found. No email sent.", 'yellow');
            return;
        }

        $email->setTo(array('insan.putranda@fpsbindonesia.net', 'info@ifplearning.id')); // Admin email
        $email->setSubject('IFP Learning - User Progress Report');
        $email->setMessage($htmlReport); // HTML content
        $email->setMailType('html');

        if ($email->send()) {
            CLI::write("Email sent successfully!", 'green');
        } else {
            CLI::error("Failed to send email: " . $email->printDebugger(['headers']));
        }
    }
}
