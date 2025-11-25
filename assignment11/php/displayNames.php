<?php
require "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$sql = "SELECT name FROM names ORDER BY name ASC";
$records = $pdo->selectNotBinded($sql);

echo json_encode([
    "status" => "success",
    "names"  => $records
]);
?>
