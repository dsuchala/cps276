<?php
session_start();
require_once "../classes/Pdo_methods.php";
require_once "../classes/Validation.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = $_POST['state'] ?? '';
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $dob = trim($_POST['dob']);
    $contacts = isset($_POST['contacts']) ? implode(", ", $_POST['contacts']) : "";
    $age = $_POST['age'] ?? '';

    $errors['fname'] = Validation::validateName($fname);
    $errors['lname'] = Validation::validateName($lname);
    $errors['address'] = Validation::validateAddress($address);
    $errors['city'] = Validation::validateCity($city);
    if (empty($state)) {
        $errors['state'] = "Please select a state.";
    } else {
        $errors['state'] = "";
    }
    $errors['phone'] = Validation::validatePhone($phone);
    $errors['email'] = Validation::validateEmail($email);
    $errors['dob'] = Validation::validateDOB($dob);
    $errors['age'] = Validation::validateAgeRange($age);

    $errors = array_filter($errors);

    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header("Location: ../index.php?page=addContact");
        exit;
    }

    $pdo = new PdoMethods();

    $sql = "INSERT INTO contacts (fname, lname, address, city, state, phone, email, dob, contacts, age) 
            VALUES (:fname, :lname, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";
    $bindings = [
        ':fname' => $fname,
        ':lname' => $lname,
        ':address' => $address,
        ':city' => $city,
        ':state' => $state,
        ':phone' => $phone,
        ':email' => $email,
        ':dob' => $dob,
        ':contacts' => $contacts,
        ':age' => $age
    ];

    $result = $pdo->other($sql, $bindings);

    if ($result['error']) {
        $_SESSION['form_errors'] = ['general' => 'There was an error adding the record'];
        $_SESSION['form_data'] = $_POST;
        header("Location: ../index.php?page=addContact");
        exit;
    } else {
        $_SESSION['form_success'] = "Contact Information Added";
        unset($_SESSION['form_data']);
        header("Location: ../index.php?page=addContact");
        exit;
    }
} else {
    header("Location: ../index.php?page=addContact");
    exit;
}
?>
