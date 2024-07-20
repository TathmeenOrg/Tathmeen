<?php
include('config.php');
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $user_id = $_SESSION['user_id'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo json_encode(['error' => 'Invalid email format']);
        exit;
    }

    // Prepare the SQL query
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    if ($stmt === false) {
        echo json_encode(['error' => 'SQL prepare failed']);
        exit;
    }
    
    $stmt->bind_param("si", $email, $user_id);
    $stmt->execute();
    $stmt->store_result();

    // Check if there is any record with the provided email that's not the current user
    if ($stmt->num_rows > 0) {
        echo json_encode(['exists' => true]); // Email is already used
    } else {
        echo json_encode(['exists' => false]); // Email is available
    }

    // Clean up
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
