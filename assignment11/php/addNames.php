
<?php
require "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

/* Make sure data was received */
if (!isset($_POST['first']) || !isset($_POST['last'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit();
}

$first = trim($_POST['first']);
$last = trim($_POST['last']);

$fullName = "$last, $first";

$sql = "INSERT INTO names (name) VALUES (:name)";
$params = [":name" => $fullName];

$result = $pdo->otherBinded($sql, $params);

if ($result === "error") {
    echo json_encode(["status" => "error", "message" => "Insert failed"]);
    exit();
}

$sql = "SELECT name FROM names ORDER BY name ASC";
$records = $pdo->selectNotBinded($sql);

echo json_encode([
    "status" => "success",
    "names"  => $records
]);
?>
