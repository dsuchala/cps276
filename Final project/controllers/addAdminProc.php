<?php
session_start();
require_once "../classes/Pdo_methods.php";
require_once "../classes/Validation.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $status = $_POST['status'] ?? '';

    $errors['name'] = Validation::validateName($name);
    $errors['email'] = Validation::validateEmail($email);
    $errors['password'] = Validation::validatePassword($password);

    if (empty($status)) {
        $errors['status'] = "Please select a status.";
    } else {
        $errors['status'] = "";
    }

    $errors = array_filter($errors);

    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header("Location: ../index.php?page=addAdmin");
        exit;
    }

    $pdo = new PdoMethods();

    $checkSql = "SELECT * FROM admins WHERE email = :email";
    $checkResult = $pdo->select($checkSql, [':email' => $email]);

    if (!$checkResult['error'] && count($checkResult['data']) > 0) {
        $_SESSION['form_errors'] = ['email' => 'Email already exists'];
        $_SESSION['form_data'] = $_POST;
        header("Location: ../index.php?page=addAdmin");
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";
    $bindings = [
        ':name' => $name,
        ':email' => $email,
        ':password' => $hashedPassword,
        ':status' => $status
    ];

    $result = $pdo->other($sql, $bindings);

    if ($result['error']) {
        $_SESSION['form_errors'] = ['general' => 'There was an error adding the record'];
        $_SESSION['form_data'] = $_POST;
        header("Location: ../index.php?page=addAdmin");
        exit;
    } else {
        $_SESSION['form_success'] = "Admin Added";
        unset($_SESSION['form_data']);
        header("Location: ../index.php?page=addAdmin");
        exit;
    }
} else {
    header("Location: ../index.php?page=addAdmin");
    exit;
}
?>
