<?php

require_once __DIR__ . "/../includes/security.php"; 
require_once __DIR__ . "/../includes/navigation.php"; 

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

if (!$page) {
    $page = 'login';
}

$allowedPages = ['login', 'welcome', 'addContact', 'deleteContacts', 'addAdmin', 'deleteAdmins'];

if (!in_array($page, $allowedPages)) {
    header("Location: index.php?page=login");
    exit;
}

if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] === 'staff' && in_array($page, ['addAdmin', 'deleteAdmins'])) {
        header("Location: index.php?page=welcome");
        exit;
    }
} else {

    header("Location: index.php?page=login");
    exit;
}

$pageFile = __DIR__ . "/../views/{$page}.php";
if (file_exists($pageFile)) {
    include $pageFile;
} else {
    echo "<h2>Page not found.</h2>";
}
