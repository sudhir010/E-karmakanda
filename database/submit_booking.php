<?php
// Start the session
session_start();

// Include DB connection
include 'config.php';

// Handle only POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        die("Invalid request.");
    }

    // Retrieve and sanitize inputs
    $fullName   = trim($_POST['fullName'] ?? '');
    $pujaType   = trim($_POST['pujaType'] ?? '');
    $date       = trim($_POST['date'] ?? '');
    $location   = trim($_POST['location'] ?? '');
    $contact    = trim($_POST['contact'] ?? '');
    $notes      = trim($_POST['notes'] ?? '');  

 
    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO bookings (full_name, puja_type, preferred_date, location, contact_number, notes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullName, $pujaType, $date, $location, $contact, $notes);

    if ($stmt->execute()) {
            header("Location: ../book.php?status=success");
            exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save booking. Try again.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
