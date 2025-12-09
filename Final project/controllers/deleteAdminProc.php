<?php
session_start();
require_once "../classes/Pdo_methods.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['delete_ids']) || !is_array($_POST['delete_ids']) || count($_POST['delete_ids']) == 0) {

        $_SESSION['delete_error'] = "No admins selected for deletion.";
        header("Location: ../index.php?page=deleteAdmins");
        exit;
    }

    $ids = $_POST['delete_ids'];

    $pdo = new PdoMethods();
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $sql = "DELETE FROM admins WHERE id IN ($placeholders)";
    $bindings = [];
    foreach ($ids as $id) {
        $bindings[] = $id;
    }

    $result = $pdo->other($sql, $bindings);

    if ($result['error']) {
        $_SESSION['delete_error'] = "Could not delete the admins";
    } else {
        $_SESSION['delete_success'] = "Admin(s) deleted";
    }

    header("Location: ../index.php?page=deleteAdmins");
    exit;
} else {
    header("Location: ../index.php?page=deleteAdmins");
    exit;
}
?>
