<?php
$host = 'localhost';
$dbname = 'ekarmakanda';
$username = 'root'; // Change this if needed
$password = '';     // Change this if needed

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CSRF token helpers
if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function csrf_token() {
    return $_SESSION['csrf_token'];
}

function csrf_field() {
    return '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '" />';
}

function verify_csrf($token) {
    return hash_equals($_SESSION['csrf_token'], $token ?? '');
}
?>
