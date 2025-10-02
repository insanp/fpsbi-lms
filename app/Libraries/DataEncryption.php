<?php

namespace App\Libraries;

use CodeIgniter\Encryption\Encryption;

class DataEncryption extends Encryption
{
    private $encryptionKey;

    public function __construct()
    {
        $this->encryptionKey = 'rmuFkuweJfiJoccrkPxCnk5dGdMZfLm90UpMJgwXj9K+SgbpAGPnMmjIM2AZaAzY';
    }

    public function encrypt_export_data($data)
    {
        // Serialize JSON data
        $jsonData = json_encode($data);

        // Generate an initialization vector (IV)
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

        // Encrypt the JSON data
        $encryptedData = openssl_encrypt($jsonData, 'aes-256-cbc', $this->encryptionKey, 0, $iv);

        // Combine IV and encrypted data
        $exportData = $iv . $encryptedData;

        return $exportData;
    }

    public function decrypt_import_data($importData)
    {
        // Retrieve the IV and encrypted data
        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($importData, 0, $ivSize);
        $encryptedData = substr($importData, $ivSize);

        // Decrypt the data
        $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $this->encryptionKey, 0, $iv);

        // Deserialize JSON data
        $importedData = json_decode($decryptedData, true);

        return $importedData;
    }
}
