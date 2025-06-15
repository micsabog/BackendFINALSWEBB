<?php
@include 'connect.php'; // DB connection file

header('Content-Type: application/json');

$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);

$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND role = 'employer' LIMIT 1") or die('query failed');

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    
    if(password_verify($pass, $row['password'])){
        echo json_encode([
            'message' => 'success',
            'user' => [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'role' => $row['role']
            ]
        ]);
    } else {
        echo json_encode(['message' => 'Incorrect password']);
    }
} else {
    echo json_encode(['message' => 'No employer account found with that email']);
}
