<?php
session_start();
require_once "../classes/Pdo_methods.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $pdo = new PdoMethods();
    $sql = "SELECT * FROM admins WHERE email = :email";
    $result = $pdo->select($sql, [':email' => $email]);

    if ($result['error']) {
        $_SESSION['loginError'] = "An error occurred. Please try again.";
        header("Location: ../index.php?page=login");
        exit;
    }

    if (count($result['data']) == 1) {
        $user = $result['data'][0];
        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['status'] = $user['status'];
            $_SESSION['email'] = $user['email'];
            header("Location: ../index.php?page=welcome");
            exit;
        }
    }

    $_SESSION['loginError'] = "Authentication failure";
    header("Location: ../index.php?page=login");
    exit;
}
?>
