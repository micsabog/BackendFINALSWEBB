<?php
$host = 'localhost';
$dbname = 'register_php';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['pass']);
    $c_pass = $conn->real_escape_string($_POST['c_pass']);

    if ($pass !== $c_pass) {
        echo "Passwords do not match!";
    } else {
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // 🔑 Add the 'role' column and set it to 'employer'
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_pass', 'employer')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../frontend/login.html"); 
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
