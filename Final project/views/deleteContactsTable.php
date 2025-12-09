<?php
session_start();
require_once "../classes/Pdo_methods.php";
require_once "includes/navigation.php";

$pdo = new PdoMethods();
$result = $pdo->select("SELECT * FROM contacts ORDER BY lname, fname");

$deleteSuccess = $_SESSION['delete_success'] ?? '';
$deleteError = $_SESSION['delete_error'] ?? '';
unset($_SESSION['delete_success'], $_SESSION['delete_error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "includes/navigation.php"; ?>

<div class="container mt-5">
    <h2>Delete Contacts</h2>

    <?php if ($deleteSuccess): ?>
        <div class="alert alert-success"><?= $deleteSuccess ?></div>
    <?php endif; ?>

    <?php if ($deleteError): ?>
        <div class="alert alert-danger"><?= $deleteError ?></div>
    <?php endif; ?>

    <?php if (empty($result['data'])): ?>
        <p>There are no records to display.</p>
    <?php else: ?>
        <form method="post" action="controllers/deleteContactProc.php">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Contacts</th>
                    <th>Age</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($result['data'] as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['fname']) ?></td>
                        <td><?= htmlspecialchars($row['lname']) ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td><?= htmlspecialchars($row['city']) ?></td>
                        <td><?= htmlspecialchars($row['state']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['dob']) ?></td>
                        <td><?= htmlspecialchars($row['contacts']) ?></td>
                        <td><?= htmlspecialchars($row['age']) ?></td>
                        <td><input type="checkbox" name="delete_ids[]" value="<?= $row['id'] ?>"></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger">Delete Selected</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
