<?php
$conn = new mysqli("localhost", "root", "", "register_php");
if ($conn->connect_error) {
    die(json_encode(["message" => "DB connection failed"]));
}

$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data["id"], $data["name"], $data["phone"], $data["address"])) {
    http_response_code(400);
    echo json_encode(["message" => "Missing required fields"]);
    exit;
}

$id = (int) $data["id"];
$name = $data["name"];
$phone = $data["phone"];
$address = $data["address"];
$password = isset($data["password"]) && !empty($data["password"]) ? password_hash($data["password"], PASSWORD_DEFAULT) : null;

// Prepare query
if ($password) {
    $stmt = $conn->prepare("UPDATE users SET name = ?, phone_number = ?, address = ?, password = ? WHERE id = ?");
    if (!$stmt) {
        echo json_encode(["message" => "Prepare failed: " . $conn->error]);
        exit;
    }
    $stmt->bind_param("ssssi", $name, $phone, $address, $password, $id);
} else {
    $stmt = $conn->prepare("UPDATE users SET name = ?, phone_number = ?, address = ? WHERE id = ?");
    if (!$stmt) {
        echo json_encode(["message" => "Prepare failed: " . $conn->error]);
        exit;
    }
    $stmt->bind_param("sssi", $name, $phone, $address, $id);
}

if ($stmt->execute()) {
    $result = $conn->query("SELECT id, name, email, phone_number, address FROM users WHERE id = $id");
    $updatedUser = $result->fetch_assoc();
    echo json_encode(["message" => "success", "user" => $updatedUser]);
} else {
    echo json_encode(["message" => "Update failed", "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
