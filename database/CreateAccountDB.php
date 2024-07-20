<?php
include('config.php');
session_start();

if (isset($_POST['CreateAccount'])) {


    $email = $_POST['email'];


    $check_stmt = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE email = ?");
    if ($check_stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $check_stmt->bind_param("s", $email);

    if (!$check_stmt->execute()) {
        die("Error executing statement: " . $check_stmt->error);
    }

    $check_result = $check_stmt->get_result();
    $row = $check_result->fetch_assoc();

    if ($row['count'] > 0) {
  
        $email_exists_error = "البريد الإلكتروني مسجل بالفعل!";
        $_SESSION['error_message'] = $email_exists_error;


        header('Location: ../dist/createAccount.php');
        exit();
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $role = $_POST['role'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("INSERT INTO users (email, firstname, lastname, gender, age, role, phone_number, password, security_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $security_code = ""; 

    $stmt->bind_param("ssssissss", $email, $firstname, $lastname, $gender, $age, $role, $phone_number, $hashed_password, $security_code);

    if ($stmt->execute() === FALSE) {
        die("Error executing statement: " . $stmt->error);
    } else {
        echo "User inserted successfully!";
    }

    $conn->close();

  
    header('Location: ../dist/index.php');
    exit();
}
?>
