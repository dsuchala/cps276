<?php

$first_name = $last_name = $email = $password = $confirm_password = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = htmlspecialchars($_POST['first_name'] ?? '');
    $last_name = htmlspecialchars($_POST['last_name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!preg_match("/^[a-zA-Z' ]+$/", $first_name)) {
        $errors['first_name'] = "Please enter a valid first name.";
    }
    if (!preg_match("/^[a-zA-Z' ]+$/", $last_name)) {
        $errors['last_name'] = "Please enter a valid last name.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
        $errors['password'] = "Password must be at least 8 characters, include 1 uppercase letter, 1 number, and 1 symbol.";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $success = "User successfully registered!";
  
        $first_name = $last_name = $email = $password = $confirm_password = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration Form</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
</head>
<body>
<div class="container mt-5">
  <h2>User Registration Form</h2>
  <p class="text-muted">Fields marked with * are required.</p>

  <?php if (!empty($success)) : ?>
    <p class="text-success"><?php echo $success; ?></p>
  <?php endif; ?>

  <form method="post">
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="first_name" class="form-label">*First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name"
               value="<?php echo $first_name; ?>" required>
        <?php if (!empty($errors['first_name'])) : ?>
          <div class="form-text text-danger"><?php echo $errors['first_name']; ?></div>
        <?php endif; ?>
      </div>

      <div class="col-md-6 mb-3">
        <label for="last_name" class="form-label">*Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name"
               value="<?php echo $last_name; ?>" required>
        <?php if (!empty($errors['last_name'])) : ?>
          <div class="form-text text-danger"><?php echo $errors['last_name']; ?></div>
        <?php endif; ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 mb-3">
        <label for="email" class="form-label">*Email</label>
        <input type="email" class="form-control" id="email" name="email"
               value="<?php echo $email; ?>" required>
        <?php if (!empty($errors['email'])) : ?>
          <div class="form-text text-danger"><?php echo $errors['email']; ?></div>
        <?php endif; ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="password" class="form-label">*Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <?php if (!empty($errors['password'])) : ?>
          <div class="form-text text-danger"><?php echo $errors['password']; ?></div>
        <?php endif; ?>
      </div>

      <div class="col-md-6 mb-3">
        <label for="confirm_password" class="form-label">*Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        <?php if (!empty($errors['confirm_password'])) : ?>
          <div class="form-text text-danger"><?php echo $errors['confirm_password']; ?></div>
        <?php endif; ?>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>
</html>
