<?php
session_start();
include 'config.php'; // Make sure this contains your DB connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Sanitize and validate input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_name'])) {
    $new_name = trim($_POST['new_name']);
    
    if (strlen($new_name) < 2) {
        // You can redirect with error if needed
        $_SESSION['error'] = "Name must be at least 2 characters long.";
        header("Location: ../index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Update in database
    $stmt = $conn->prepare("UPDATE users SET fullname = ? WHERE id = ?");
    $stmt->bind_param("si", $new_name, $user_id);

    if ($stmt->execute()) {
        $_SESSION['fullname'] = $new_name; // Update session
        $_SESSION['success'] = "Name updated successfully.";
    } else {
        $_SESSION['error'] = "Something went wrong. Try again.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
