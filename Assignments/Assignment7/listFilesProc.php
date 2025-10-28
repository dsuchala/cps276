<?php
require_once 'classes/Pdo_methods.php';

$output = '';

$pdo = new PdoMethods();

$sql = "SELECT id, file_name, file_path FROM pdf_files ORDER BY id DESC";

$result = $pdo->selectNotBinded($sql);

if ($result !== 'error') {
    if (count($result) > 0) {
        
        $output .= '<ul>';
        foreach ($result as $row) {
            $fileId = htmlspecialchars($row['id']);
            $fileName = htmlspecialchars($row['file_name']);
            $filePath = htmlspecialchars($row['file_path']);
            $output .= "<li><a target='_blank' href='$filePath'>$fileName</a></li>";
        }
        
        $output .= '</ul>';
        
    } else {
        $output = '<div class="no-files">No PDF files have been uploaded yet.</div>';
    }
    
} else {
    $output = '<div class="message error">Error retrieving files from database.</div>';
}
