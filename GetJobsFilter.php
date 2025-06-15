<?php

require_once 'dbcon.php';

if (!$conn) {
    echo json_encode(["error" => "Failed to connect to database"]);
    exit();
}

// Get query parameters
$title = $_GET['title'] ?? '';
$location = $_GET['location'] ?? '';

// Query to fetch filtered jobs
$query = "SELECT * FROM jobs WHERE job_title LIKE '%$title%' AND location LIKE '%$location%'";
$result = mysqli_query($conn, $query);

$jobs = [];

while ($row = mysqli_fetch_assoc($result)) {
    $jobs[] = $row;
}

echo json_encode($jobs);
?>
