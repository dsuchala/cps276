<?php
require_once 'Pdo_Methods.php';
class Date_time {
    private $pdo;
    
    public function __construct() {
        $this->pdo = new PdoMethods();
    }
    
    public function checkSubmit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['addNote'])) {
                return $this->addNote();
            } elseif (isset($_POST['getNotes'])) {
                return $this->displayNotes();
            }
        }
        return '';
    }
    
    private function addNote() {
        $dateTime = isset($_POST['dateTime']) ? trim($_POST['dateTime']) : '';
        $note = isset($_POST['note']) ? trim($_POST['note']) : '';
        
        if (empty($dateTime) || empty($note)) {
            return '<div class="alert alert-danger">You must enter a date, time, and note.</div>';
        }
        
        $timestamp = strtotime($dateTime);
        
        if ($timestamp === false) {
            return '<div class="alert alert-danger">Invalid date/time format.</div>';
        }
        
        $sql = "INSERT INTO note (date_time, note) VALUES (:timestamp, :note)";
        $bindings = [
            [':timestamp', $timestamp, 'int'],
            [':note', $note, 'str']
        ];
        
        $result = $this->pdo->otherBinded($sql, $bindings);
        
        if ($result === 'noerror') {
            return '<div class="alert alert-success">Note added successfully!</div>';
        } else {
            return '<div class="alert alert-danger">Error adding note. Please try again.</div>';
        }
    }
    
    private function displayNotes() {
        $begDate = isset($_POST['begDate']) ? trim($_POST['begDate']) : '';
        $endDate = isset($_POST['endDate']) ? trim($_POST['endDate']) : '';
        
        if (empty($begDate) || empty($endDate)) {
            return '<div class="alert alert-danger">No notes found for the date range selected.</div>';
        }
        
        $begTimestamp = strtotime($begDate . ' 00:00:00');
        $endTimestamp = strtotime($endDate . ' 23:59:59');
        
        if ($begTimestamp === false || $endTimestamp === false) {
            return '<div class="alert alert-danger">Invalid date format.</div>';
        }
        
        $sql = "SELECT timestamp, note FROM notes WHERE timestamp BETWEEN :begDate AND :endDate ORDER BY timestamp DESC";
        $bindings = [
            [':begDate', $begTimestamp, 'int'],
            [':endDate', $endTimestamp, 'int']
        ];
        
        $result = $this->pdo->selectBinded($sql, $bindings);
        
        if ($result === 'error') {
            return '<div class="alert alert-danger">Error retrieving notes. Please try again.</div>';
        }
        
        if (!is_array($result) || empty($result)) {
            return '<div class="alert alert-info">No notes found for the date range selected.</div>';
        }
        
        $output = '<div class="table-responsive">';
        $output .= '<table class="table table-striped table-bordered">';
        $output .= '<thead class="table-dark"><tr><th>Date/Time</th><th>Note</th></tr></thead>';
        $output .= '<tbody>';
        
        foreach ($result as $row) {
            if (isset($row['timestamp']) && is_numeric($row['timestamp'])) {
                $formattedDate = date('m/d/Y h:i A', $row['timestamp']);
            } else {
                $formattedDate = 'Invalid Date';
            }
            
            $noteText = isset($row['note']) ? htmlspecialchars($row['note']) : '';
            $output .= "<tr><td>{$formattedDate}</td><td>{$noteText}</td></tr>";
        }
        
        $output .= '</tbody></table></div>';
        
        return $output;
    }
}
?>
