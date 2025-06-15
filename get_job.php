<?php
require_once 'dbcon.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;

$sql = "SELECT * FROM jobs WHERE id = $job_id LIMIT 1";
$result = $conn->query($sql);

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(null);
}
?>
