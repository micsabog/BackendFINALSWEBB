<?php
$conn = new mysqli("localhost", "root", "", "register_php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            unset($row['password']); // Optional: don't return hashed password
            echo json_encode([
                "message" => "success",
                "user" => $row
            ]);
        } else {
            echo " ❗ Invalid email or password ❗";
        }
    } else {
        echo " ❗ Invalid email or password ❗";
    }
}

$conn->close();
?>
