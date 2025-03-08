<?php
require "../vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret_key = "iwhhu9wehfgggowebnr84gbhgi";

function generateJWT($payload) {
    global $secret_key;
    return JWT::encode($payload, $secret_key, "HS256");
}

function verifyJWT($token) {
    global $secret_key;
    try {
        return JWT::decode($token, new Key($secret_key, "HS256"));
    } catch (Exception $e) {
        return false;
    }
}
?>
