<?php
session_start();
include 'config.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // CSRF check
        if (!verify_csrf($_POST['csrf_token'] ?? '')) {
            die("Invalid request.");
        }

        // Get form data
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $phonenumber = trim($_POST['phonenumber']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirmpassword']);

        // Basic validation
        if (empty($fullname) || empty($email) || empty($phonenumber) || empty($password) || empty($confirm_password)) {
            die("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format.");
        }
       
        if ($password !== $confirm_password) {
            die("Passwords do not match.");
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and execute insert
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, phonenumber, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $email, $phonenumber, $hashed_password);
        $stmt->execute();

        // Redirect to login page after success
        header("Location: ../login.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    if (str_contains($e->getMessage(), "Duplicate entry")) {
        // Redirect back to signup with error message
        header("Location: ../signup.php?error=duplicate_email");
        exit();
    } else {
        echo "Database error: " . $e->getMessage();
    }
}

$conn->close();
?>