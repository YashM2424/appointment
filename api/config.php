<?php
$host = "localhost";
$user = "root"; 
$pass = "";  
$dbname = "appointment_db";  

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed"]));
}
?>
