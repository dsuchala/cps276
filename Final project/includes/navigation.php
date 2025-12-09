<?php
session_start();

if (!isset($_SESSION['status'])) {
    return;
}

$status = $_SESSION['status'];

echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">';
echo '<a class="navbar-brand" href="index.php?page=welcome">Home</a>';
echo '<div class="collapse navbar-collapse">';
echo '<ul class="navbar-nav mr-auto">';

echo '<li class="nav-item"><a class="nav-link" href="index.php?page=addContact">Add Contact</a></li>';
echo '<li class="nav-item"><a class="nav-link" href="index.php?page=deleteContacts">Delete Contact(s)</a></li>';

if ($status === 'admin') {
    echo '<li class="nav-item"><a class="nav-link" href="index.php?page=addAdmin">Add Admin</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="index.php?page=deleteAdmins">Delete Admin(s)</a></li>';
}

echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';

echo '</ul></div></nav>';
?>

