<?php
require_once 'classes/Pdo_methods.php';

$output = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['submit'])) {
        
        $fileName = trim($_POST['fileName']);
        $file = $_FILES['pdfFile'];
        
        if (empty($fileName)) {
            $output = '<div class="message error">Please enter a file name.</div>';
        }
        elseif ($file['error'] !== UPLOAD_ERR_OK) {
            $output = '<div class="message error">Error uploading file. Please try again.</div>';
        }

        elseif ($file['size'] > 100000) {
            $output = '<div class="message error">File size must be under 100KB. Your file is ' . number_format($file['size']) . ' bytes.</div>';
        }

        elseif ($file['type'] !== 'application/pdf') {
            $output = '<div class="message error">File must be a PDF. Uploaded file type: ' . $file['type'] . '</div>';
        }
        else {
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $uniqueFileName = uniqid() . '_' . basename($file['name']);
            $uploadDir = 'files/';
            $filePath = $uploadDir . $uniqueFileName;
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                
                $pdo = new PdoMethods();
                
                $sql = "INSERT INTO pdf_files (file_name, file_path) VALUES (:fileName, :filePath)";
                
                $bindings = [
                    [':fileName', $fileName, 'str'],
                    [':filePath', $filePath, 'str']
                ];
                
                $result = $pdo->otherBinded($sql, $bindings);
                
                if ($result === 'noerror') {
                    $output = '<div class="message success">File "' . htmlspecialchars($fileName) . '" uploaded successfully!</div>';
                } else {

                    unlink($filePath);
                    $output = '<div class="message error">Database error. File was not saved.</div>';
                }
                
            } else {
                $output = '<div class="message error">Failed to move uploaded file to server directory.</div>';
            }
        }
    }
}
