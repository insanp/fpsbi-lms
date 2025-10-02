<?php

namespace App\Controllers\Member;

use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Libraries\DataEncryption;
use CodeIgniter\HTTP\Exceptions\HTTPException;

class Home extends \App\Controllers\BaseController
{
  private $session;
  private $sessionData;

  public function __construct()
  {
    // Ensure the session library is loaded
    $this->session = session();

    // Load the UserModel or any other necessary models
    $this->sessionData = $this->session->get('user');
  }

  public function dashboard()
  {
    return view('member/pages/dashboard', ['sessionData' => $this->sessionData]);
  }

  public function index()
  {
    return redirect()->to('member/dashboard');
  }

  public function export()
  {
    $data = session()->getFlashdata('export_temp');
    session()->setFlashdata('export_temp', $data); // for multiple downloads

    if (is_null($data)) {
      return redirect()->to('/member');
    }

    unset($data['data']['csrf_test_name']);

    $helper = new DataEncryption();
    $json = $helper->encrypt_export_data($data);
    $filename = url_title($data['data']['name'] . '_' . $data['toolKey'], '_', false) . '_' . date('Ymd') . '.afci';

    header('Content-Type: application/afci');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    echo $json;
    exit;
  }

  public function import()
  {
    if ($this->request->getPost()) {
      // Retrieve the uploaded file
      $uploadedFile = $this->request->getFile('importFile');

      // Check if a file was uploaded and it's an AFCI file
      if ($uploadedFile && $uploadedFile->isValid() && $uploadedFile->getClientExtension() === 'afci') {
        $jsonContent = $uploadedFile->openFile()->fread($uploadedFile->getSize());
        $redirectUrl = $_POST['redirectUrl'];

        $helper = new DataEncryption();
        $importedData = $helper->decrypt_import_data($jsonContent);
        //$importedData = json_decode($jsonContent, true);

        if ($importedData !== null) {
          if (!isset($importedData['toolKey']) || $importedData['toolKey'] != $_POST['toolKey']) {
            return redirect()->back()->with('validation_errors', ['File ini bukan untuk ' . $_POST['toolKey'] . '.']);
          }
          $_POST = $importedData['data'];
          return redirect()->to($redirectUrl)->withInput()->with('success', 'File berhasil diunggah.');
        } else {
          // JSON decoding error
          return redirect()->back()->with('validation_errors', ['File telah rusak.']);
        }
      } else {
        // Invalid or missing file
        return redirect()->back()->with('validation_errors', ['Mohon pilih file yang valid.']);
      }
    }

    // Render the import form view
    return redirect()->to('member');
  }

  public function checkFileAJAX()
  {
    if ($this->request->getPost()) {
      // Retrieve the uploaded file
      $uploadedFile = $this->request->getFile('importFile');

      // Check if a file was uploaded and it's an AFCI file
      if ($uploadedFile && $uploadedFile->isValid() && $uploadedFile->getClientExtension() === 'afci') {
        $jsonContent = $uploadedFile->openFile()->fread($uploadedFile->getSize());

        $helper = new DataEncryption();
        $importedData = $helper->decrypt_import_data($jsonContent);

        if ($importedData !== null) {
          if (!isset($importedData['toolKey']) || $importedData['toolKey'] != $_POST['toolKey']) {
            return json_encode(array('error' => 'File ini bukan untuk ' . $_POST['toolKey'] . '.'));
          }
          $_POST = $importedData['data'];
          return json_encode(array('success' => 'File berhasil diunggah.'));
        } else {
          // JSON decoding error
          return json_encode(array('error' => 'File telah rusak.'));
        }
      } else {
        // Invalid or missing file
        return json_encode(array('error' => 'Mohon pilih file yang valid.'));
      }
    }

    // Render the import form view
    return json_encode(array('error' => 'Gagal upload.'));
  }

  public function download($filename)
  {
    // Sanitize and validate the filename to prevent directory traversal
    $cleanFilename = basename($filename); // This will strip any path characters
    $filePath = '../data/files/' . $cleanFilename;

    if ($cleanFilename !== $filename) {
      throw new HttpException('File tidak ditemukan.', 404);
    }

    // Check if the file exists
    if (file_exists($filePath)) {
      // Return the file as a download response
      return $this->response->download($filePath, null)->setFileName($cleanFilename);
    } else {
      // If the file doesn't exist, show an error
      throw new HttpException('File tidak ditemukan.', 404);
    }
  }

  public function noAccess()
  {
    return view('member/pages/no_access', ['sessionData' => $this->sessionData]);
  }
}
