<?php
$conn = new mysqli("localhost", "root", "", "register_php");
if ($conn->connect_error) {
    die("DB error");
}

$data = json_decode(file_get_contents("php://input"), true);
$id = $conn->real_escape_string($data["id"]);

$sql = "DELETE FROM users WHERE id='$id'";
echo $conn->query($sql) ? "success" : "delete failed";
$conn->close();
?>
