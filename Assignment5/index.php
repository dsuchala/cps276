<?php
include_once 'classes/Directories.php';
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $directoryName = $_POST['directoryName'];
    $fileContent = $_POST['fileContent'];
    $directories = new Directories();
    $result = $directories->createDirectoryAndFile($directoryName, $fileContent);

    if ($result['status'] === 'success') {
        $successMessage = $result['message'];
    } else {
        $errorMessage = $result['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File and Directory Assignment</title>
    <!-- Bootstrap CSS Only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }

        .form-container {
            max-width: 700px;
            margin: 40px auto;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
            box-shadow: none;
        }

        h1 {
            font-weight: bold;
        }

        .small-text {
            font-size: 0.95rem;
            color: #555;
        }

        .alert {
            max-width: 700px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

    <div class="text-center mt-5">
        <h1>File and Directory Assignment</h1>
        <p class="small-text">Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>
    </div>

    <?php if ($successMessage): ?>
        <div class="alert alert-success text-center">
            <p>File created successfully.</p>
            <a href="<?= $successMessage ?>" target="_blank">Path where the file is located</a>
        </div>
    <?php elseif ($errorMessage): ?>
        <div class="alert alert-danger text-center">
            <p><?= $errorMessage ?></p>
        </div>
    <?php endif; ?>
    <div class="form-container">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="directoryName" class="form-label">Folder Name</label>
                <input type="text" name="directoryName" id="directoryName" class="form-control" required pattern="[A-Za-z0-9]+" title="Only alphanumeric characters allowed">
            </div>

            <div class="mb-3">
                <label for="fileContent" class="form-label">File Content</label>
                <textarea name="fileContent" id="fileContent" class="form-control" rows="6" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>
</html>
