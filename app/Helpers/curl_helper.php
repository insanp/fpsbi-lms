<?php
if (!function_exists('callCurl')) {
    function callCurl($url, $method, $data = null)
    {
        $ch = curl_init();

        // Set options for cURL based on method
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        // Set headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        // Set POST data if provided
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        // Execute request and get response
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return ['error' => $error_msg];
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
