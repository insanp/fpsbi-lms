<?php

if (!function_exists('article_url')) {
    function article_url($article)
    {
        return base_url("articles/{$article['slug']}");
    }
}

if (!function_exists('convert_to_slug')) {
    function convert_to_slug($title)
    {
        $slug = url_title($title, '-', true);
        return $slug;
    }
}

if (!function_exists('sanitize_html')) {
    function sanitize_html($string)
    {
        $allowTag = '<br><p><strong><b><em><i><u><h1><h2><h3><h4><h5>';
        return strip_tags($string, $allowTag);
    }
}

if (!function_exists('encrypt_export_data')) {
    function encrypt_export_data($data)
    {
        // Serialize JSON data
        $jsonData = json_encode($data);

        // Generate an initialization vector (IV)
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

        // Encrypt the JSON data
        $encryptedData = openssl_encrypt($jsonData, 'aes-256-cbc', 'ac4demyFin4nc1al', 0, $iv);

        // Combine IV and encrypted data
        $exportData = $iv . $encryptedData;

        return $exportData;
    }
}

if (!function_exists('decrypt_import_data')) {
    function decrypt_import_data($string)
    {
        
    }
}

if (!function_exists('mask_email')) {
    function mask_email($email) {
        list($localPart, $domain) = explode('@', $email);
        $maskedLocal = substr($localPart, 0, 1) . str_repeat('*', max(0, strlen($localPart) - 2)) . substr($localPart, -1);
        $domainParts = explode('.', $domain);
        $maskedDomain = substr($domainParts[0], 0, 1) . str_repeat('*', max(0, strlen($domainParts[0]) - 2)) . substr($domainParts[0], -1);
        $maskedDomain .= '.' . substr($domainParts[1], 0, 1) . str_repeat('*', max(0, strlen($domainParts[1]) - 2)) . substr($domainParts[1], -1);
        return $maskedLocal . '@' . $maskedDomain;
    }
}

if (!function_exists('penilaian_essay')) {
    function penilaian_essay($score, $max) {
        $pctg = $score / $max;
        if ($pctg > 0.8) {
            return '<strong style="color:darkgreen">Sangat baik</strong>';
        } else if ($pctg > 0.6) {
            return '<strong style="color:green">Baik</strong>';
        } else if ($pctg > 0.4) {
            return '<strong style="color:blue">Cukup</strong>';
        } else if ($pctg >= 0.2) {
            return '<strong style="color:orange">Kurang</strong>';
        } else {
            return '<strong style="color:red">Tidak relevan</strong>';
        }
    }
}