<?php
include('config.php');
session_start();
var_dump($_POST);
if (isset($_POST['updateAccount'])) {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = 2;
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $role = $_POST['role'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE users SET email=?, firstname=?, lastname=?, gender=?, age=?, role=?, phone_number=?, password=? WHERE id=?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssisssi", $email, $firstname, $lastname, $gender, $age, $role, $phone_number, $password, $user_id);

    // Execute statement
    if ($stmt->execute() === FALSE) {
        die("Error executing statement: " . $stmt->error);
    } else {
        echo "User updated successfully!";
    }

    $stmt->close();
    $conn->close();
    header('Location: index.php');
    exit();
}
?>
