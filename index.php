<?php
header("Content-Type: application/json");

echo json_encode([
    "status" => "success",
    "message" => "Welcome to the Appointment Booking API",
    "usage" => "Refer to the API documentation for available endpoints"
], JSON_PRETTY_PRINT);
?>
