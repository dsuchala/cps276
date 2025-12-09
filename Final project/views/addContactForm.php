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
    <title>Add Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "includes/navigation.php"; ?>

<div class="container mt-5">
    <h2>Add Contact</h2>

    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?= $successMessage ?></div>
    <?php endif; ?>

    <?php if (isset($errors['general'])): ?>
        <div class="alert alert-danger"><?= $errors['general'] ?></div>
    <?php endif; ?>

    <form action="controllers/addContactProc.php" method="post" novalidate>
        <div class="mb-3">
            <label for="fname" class="form-label">First Name *</label>
            <input type="text" id="fname" name="fname" class="form-control"
                   value="<?= htmlspecialchars($data['fname'] ?? '') ?>">
            <?php if (isset($errors['fname'])): ?>
                <div class="text-danger"><?= $errors['fname'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="lname" class="form-label">Last Name *</label>
            <input type="text" id="lname" name="lname" class="form-control"
                   value="<?= htmlspecialchars($data['lname'] ?? '') ?>">
            <?php if (isset($errors['lname'])): ?>
                <div class="text-danger"><?= $errors['lname'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address *</label>
            <input type="text" id="address" name="address" class="form-control"
                   value="<?= htmlspecialchars($data['address'] ?? '') ?>">
            <?php if (isset($errors['address'])): ?>
                <div class="text-danger"><?= $errors['address'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City *</label>
            <input type="text" id="city" name="city" class="form-control"
                   value="<?= htmlspecialchars($data['city'] ?? '') ?>">
            <?php if (isset($errors['city'])): ?>
                <div class="text-danger"><?= $errors['city'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="state" class="form-label">State *</label>
            <select name="state" id="state" class="form-select">
                <option value="">--Select State--</option>
                <?php
                $states = ["MI", "CA", "NY", "TX", "FL"];
                foreach ($states as $state) {
                    $selected = (isset($data['state']) && $data['state'] === $state) ? "selected" : "";
                    echo "<option value=\"$state\" $selected>$state</option>";
                }
                ?>
            </select>
            <?php if (isset($errors['state'])): ?>
                <div class="text-danger"><?= $errors['state'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone (999.999.9999) *</label>
            <input type="text" id="phone" name="phone" class="form-control"
                   value="<?= htmlspecialchars($data['phone'] ?? '') ?>">
            <?php if (isset($errors['phone'])): ?>
                <div class="text-danger"><?= $errors['phone'] ?></div>
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
            <label for="dob" class="form-label">DOB (mm/dd/yyyy) *</label>
            <input type="text" id="dob" name="dob" class="form-control"
                   value="<?= htmlspecialchars($data['dob'] ?? '') ?>">
            <?php if (isset($errors['dob'])): ?>
                <div class="text-danger"><?= $errors['dob'] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label>Contacts (checkboxes)</label><br>
            <?php
            $contactsOptions = ['Email', 'Phone', 'Mail'];
            foreach ($contactsOptions as $contactOption) {
                $checked = "";
                if (isset($data['contacts']) && is_array($data['contacts']) && in_array($contactOption, $data['contacts'])) {
                    $checked = "checked";
                }
                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='checkbox' name='contacts[]' value='$contactOption' $checked>";
                echo "<label class='form-check-label'>$contactOption</label>";
                echo "</div>";
            }
            ?>
        </div>

        <div class="mb-3">
            <label>Age Range *</label><br>
            <?php
            $ageRanges = ['Under 18', '18-35', '36-50', '51 and above'];
            foreach ($ageRanges as $ageRange) {
                $checked = (isset($data['age']) && $data['age'] === $ageRange) ? "checked" : "";
                echo "<div class='form-check form-check-inline'>";
                echo "<input class='form-check-input' type='radio' name='age' value='$ageRange' $checked>";
                echo "<label class='form-check-label'>$ageRange</label>";
                echo "</div>";
            }
            ?>
            <?php if (isset($errors['age'])): ?>
                <div class="text-danger"><?= $errors['age'] ?></div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Add Contact</button>
    </form>
</div>
</body>
</html>
