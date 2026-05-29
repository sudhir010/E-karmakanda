<?php
session_start();

// Database connection
include 'config.php';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF check
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        die("Invalid request.");
    }

    $email = trim($_POST['email']);
    $password_input = trim($_POST['password']);

    // Basic validation
    if (empty($email) || empty($password_input)) {
        die("Please fill in all fields.");
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password_input, $user['password'])) {
            // Set session or proceed
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];

            // Redirect to index.html
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../login.php?error=invalid_credentials");
            exit();
        }
    } else {
        header("Location: ../login.php?error=invalid_credentials");
        exit();
    }

    $stmt->close();
}

$conn->close();
