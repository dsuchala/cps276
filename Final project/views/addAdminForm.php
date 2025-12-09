<?php
session_start();
require_once "../classes/StickyForm.php";

$errors = $_SESSION['form_errors'] ?? [];
$data = $_SESSION['form_data'] ?? [];
$successMessage = $_SESSION['form_success'] ?? '';
unset($_SESSION['form_errors'], $_SESSION['form_data'], $_SESSION['form_success']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "includes/navigation.php"; ?>

<div class="container mt-5">
    <h2>Add Admin</h2>

    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?= $successMessage ?></div>
    <?php endif; ?>

    <?php if (isset($errors['general'])): ?>
        <div class="alert alert-danger"><?= $errors['general'] ?></div>
    <?php endif; ?>

    <form action="controllers/addAdminProc.php" method="post" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" id="name" name="name" class="form-control"
                   value="<?= htmlspecialchars($data['name'] ?? '') ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="text-danger"><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" id="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($data['email'] ?? '') ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="text-danger"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password *</label>
            <input type="password" id="password" name="password" class="form-control">
            <?php if (isset($errors['password'])): ?>
                <div class="text-danger"><?= $errors['password'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status *</label>
            <select name="status" id="status" class="form-select">
                <option value="">--Select Status--</option>
                <option value="staff" <?= (isset($data['status']) && $data['status'] === 'staff') ? 'selected' : '' ?>>Staff</option>
                <option value="admin" <?= (isset($data['status']) && $data['status'] === 'admin') ? 'selected' : '' ?>>Admin</option>
            </select>
            <?php if (isset($errors['status'])): ?>
                <div class="text-danger"><?= $errors['status'] ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Add Admin</button>
    </form>
</div>
</body>
</html>
