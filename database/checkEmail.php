<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];

    $check_stmt = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE email = ?");
    if ($check_stmt === false) {
        die(json_encode(['error' => 'Error preparing statement: ' . $conn->error]));
    }

    $check_stmt->bind_param("s", $email);

    if (!$check_stmt->execute()) {
        die(json_encode(['error' => 'Error executing statement: ' . $check_stmt->error]));
    }

    $check_result = $check_stmt->get_result();
    $row = $check_result->fetch_assoc();


    if ($row['count'] > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
} else {
 
    echo json_encode(['error' => 'Invalid request']);
}
?>
