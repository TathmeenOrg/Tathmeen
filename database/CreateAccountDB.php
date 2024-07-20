<?php
include('config.php');
session_start();

header('Content-Type: application/json');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'فشل الاتصال: ' . $conn->connect_error]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $role = $_POST["role"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST["password"];
    $security_code = null;

    $sql = "INSERT INTO users (email, firstname, lastname, gender, age, role, phone_number, password, security_code) 
            VALUES ('$email', '$firstname', '$lastname', '$gender', '$age', '$role', '$phone_number', '$password', null)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'خطأ: ' . $sql . '<br>' . $conn->error]);
    }
}

$conn->close();
?>
