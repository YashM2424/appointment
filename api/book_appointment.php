<?php
include "config.php";
include "validate_token.php";

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Invalid Request"]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $decoded_jwt->id;

if (!empty($data['date_time']) && !empty($data['description'])) {
    $date_time = $data['date_time'];
    $description = $data['description'];

    $stmt = $conn->prepare("INSERT INTO appointments (user_id, date_time, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $date_time, $description);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Appointment booked"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Booking failed"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
}
?>
