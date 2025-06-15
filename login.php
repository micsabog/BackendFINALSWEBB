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
        $user = $result->fetch_assoc();
        if (password_verify($pass, $user['password'])) {
            unset($user['password']);

            echo json_encode([
                "message" => "success",
                "user" => $user
            ]);
        } else {
            echo json_encode(["message" => " ❗ Invalid email or password ❗"]);
        }
    } else {
        echo json_encode(["message" => " ❗ Invalid email or password ❗"]);
    }
}

$conn->close();
?>

