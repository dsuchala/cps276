<?php
session_start();
if (!isset($_SESSION['status']) || !isset($_SESSION['name'])) {
    header("Location: index.php?page=login");
    exit;
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if ($_SESSION['status'] === 'staff') {

        if ($page === 'addAdmin' || $page === 'deleteAdmins') {
            header("Location: index.php?page=login");
            exit;
        }
    }

}
?>
