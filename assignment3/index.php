<?php
$output = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once 'processNames.php';
    $output = addClearNames();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add names</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">add names</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="index.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Enter Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="">
                            </div>
                            
                            <div class="mb-3">
                                <label for="namelist" class="form-label">Name List:</label>
                                <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist"><?php echo $output; ?></textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex">
                                <button type="submit" name="action" value="add" class="btn btn-success">Add Name</button>
                                <button type="submit" name="action" value="clear" class="btn btn-danger">Clear Names</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>