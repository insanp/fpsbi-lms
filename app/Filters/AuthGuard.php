<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $sessionData = $session->get('user');

        // Check if the user is logged in
        if (empty($sessionData)) {
            // Store the current URL in the session
            $session->set('redirect_url', current_url());

            $session->setFlashdata('message', 'Silakan login terlebih dahulu.');
            // Redirect to the login page if the user is not logged in
            return redirect()->to('/auth/login-form');
        } else if (!$sessionData['is_active']) {
            return redirect()->to('/auth/logout')->with('inactive', 1);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
