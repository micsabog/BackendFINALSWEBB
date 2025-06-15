<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "register_php";

// Connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$job_title = $_POST['job_title'];
$salary = $_POST['salary'];
$location = $_POST['location'];
$job_type = $_POST['job_type'];
$shift = $_POST['shift'];
$company_name = $_POST['company_name'];
$job_description = $_POST['job_description'];

// Current date
$date = date("Y-m-d");

// Insert query
$sql = "INSERT INTO jobs (job_title, salary, location, job_type, shift, date, job_description, company_name)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sdssssss", $job_title, $salary, $location, $job_type, $shift, $date, $job_description, $company_name);

if ($stmt->execute()) {
    if (empty($_POST['job_title']) || empty($_POST['salary'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }
        echo json_encode(['success' => true, 'message' => 'Job posted successfully!']);
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
