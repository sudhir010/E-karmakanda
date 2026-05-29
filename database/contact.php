<?php
// database/contact.php

// Include database connection
include 'config.php';

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // CSRF check
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        die("Invalid request.");
    }

    // Sanitize user input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        die("Please fill in all required fields.");
    }

    // Prepare SQL and bind parameters to prevent SQL injection
    $sql = "INSERT INTO contact_messages (name, email, message, created_at) VALUES (?, ?, ?, NOW())";

    // Use prepared statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $name, $email, $message);

    // Execute and check result
    if ($stmt->execute()) {
        // Redirect to contact page with success flag
        header("Location: ../contact.php?status=success");
        exit();
    } else {
        echo "Something went wrong. Please try again.";
    }

    $stmt->close();
    $conn->close();
} else {
    // If accessed directly
    echo "Invalid request.";
}
