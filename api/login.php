<?php
include "config.php";
require "./jwt_helper.php";

$data = json_decode(file_get_contents("php://input"), true);

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Invalid Request"]);
    exit();
}

if (!empty($data['email']) && !empty($data['password'])) {
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $email, $hashed_password, $role);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $token = generateJWT(["id" => $id, "email" => $email, "role" => $role]);
        echo json_encode(["status" => "success", "token" => $token]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Missing credentials"]);
}
?>
