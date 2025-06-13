<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'register_php';
$username = 'root';
$password = '';

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['pass']);
    $c_pass = $conn->real_escape_string($_POST['c_pass']);

    if ($pass !== $c_pass) {
        echo "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Insert into database (change 'users' to your table name if necessary)
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_pass')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            header("Location: ../frontend/login.html"); 
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
