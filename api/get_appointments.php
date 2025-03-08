<?php
include "config.php";
include "validate_token.php";

if($_SERVER["REQUEST_METHOD"] !== "GET"){
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Invalid Request"]);
    exit();
}

$stmt = $conn->prepare("SELECT id, date_time, description, status FROM appointments WHERE user_id = ?");
$stmt->bind_param("i", $decoded_jwt->id);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode(["status" => "success", "appointments" => $appointments]);
?>
