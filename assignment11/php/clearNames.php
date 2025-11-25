<?php
require "../classes/Pdo_methods.php";

$pdo = new PdoMethods();
$sql = "DELETE FROM names";
$result = $pdo->otherNotBinded($sql);

if ($result === "error") {
    echo json_encode(["status" => "error", "message" => "Could not clear names"]);
    exit();
}

echo json_encode(["status" => "success", "message" => "All names cleared"]);
?>
