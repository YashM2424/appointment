<?php
include "jwt_helper.php";

// Get all request headers
$headers = getallheaders();

// Check if Authorization header is set
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Authorization header missing"]);
    exit;
}

// Extract the token from "Bearer <token>"
$authHeader = $headers['Authorization'];
$token = str_replace("Bearer ", "", $authHeader);

// Verify the token
$decoded_jwt = verifyJWT($token);

if (!$decoded_jwt) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Invalid or expired token"]);
    exit;
}
?>
