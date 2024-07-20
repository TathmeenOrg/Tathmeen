<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $role = $_POST['role'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE users SET email=?, firstname=?, lastname=?, gender=?, age=?, role=?, phone_number=?, password=? WHERE id=?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssisssi", $email, $firstname, $lastname, $gender, $age, $role, $phone_number, $password, $user_id);

    if ($stmt->execute() === FALSE) {
        echo 'خطأ في التنفيذ';
    } else {
        echo 'تم التحديث بنجاح';
    }

    $stmt->close();
    $conn->close();
} else {
    echo "النموذج لم يتم إرساله";
}
?>
