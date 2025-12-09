<?php
session_start();
require_once "includes/navigation.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "includes/navigation.php"; ?>
<div class="container mt-5">
    <h1>Welcome <?= htmlspecialchars($_SESSION['name']) ?></h1>
    <p>Use the navigation above to access the pages you have permission for.</p>
</div>
</body>
</html>
