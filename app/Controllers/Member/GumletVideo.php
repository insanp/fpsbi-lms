<?php

namespace App\Controllers\Member;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Exceptions\HTTPException;

class GumletVideo extends \App\Controllers\BaseController
{
    private $cache;
    private $session;
    private $sessionData;

    private $gumletSecret = "a9ea1a7754a43beeb79b06e4ea841d5a";

    public function __construct()
    {
        $this->cache = \Config\Services::cache();

        // Ensure the session library is loaded
        $this->session = session();

        // Load the UserModel or any other necessary models
        $this->sessionData = $this->session->get('user');
    }

    public function generateSignedUrl($playbackUrl)
    {
        $tokenLifetime = 3600; // 1 hour
        $expiration = time() + $tokenLifetime;
        $urlPath = parse_url($playbackUrl, PHP_URL_PATH);
        $stringForTokenGeneration = $urlPath . $expiration;

        // Create the signature using SHA-1 HMAC
        $signature = hash_hmac('sha1', $stringForTokenGeneration, base64_decode($this->gumletSecret));

        // Return the signed URL
        return "{$playbackUrl}?token={$signature}&expires={$expiration}";
    }

    public function getSignedUrl()
    {
        $json = $this->request->getJSON();
        $playbackUrl = $json->playbackUrl ?? null;
        $resolutions = $json->resolutions ?? [];

        // Validate the input URL
        if (!$playbackUrl || empty($resolutions)) {
            return $this->response->setStatusCode(400)
                ->setJSON(['error' => 'Playback URL and resolutions are required']);
        }

        // Generate the signed URL
        $signedUrls = [
            'main' => $this->generateSignedUrl($playbackUrl), // Sign main playback URL
            'resolutions' => []
        ];

        foreach ($resolutions as $resolution => $resolutionPath) {
            $resolutionUrl = str_replace('main.m3u8', $resolutionPath, $playbackUrl);
            $signedUrls['resolutions'][$resolution] = $this->generateSignedUrl($resolutionUrl);
        }

        // Return JSON response with the signed URL
        return $this->response->setJSON(['signedUrls' => $signedUrls]);
    }

    public function generateGumletVideoJS()
    {
        $json = $this->request->getJSON();
        $playbackUrl = $json->playbackUrl ?? null;

        // Validate the input URL
        if (!$playbackUrl) return null;

        $signedUrl = $this->generateSignedUrl($playbackUrl);

        $data = array();
        $data['sessionData'] = $this->sessionData;
        $data['playbackUrlSigned'] = $signedUrl;

        return view('member/pages/qfc/widgets/gumlet_video.php', $data);
    }
}
