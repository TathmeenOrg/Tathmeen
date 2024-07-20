<?php
include('config.php');
session_start();

if (isset($_POST['CreateAccount'])) {
    // Validate and sanitize inputs (assuming you have validation/sanitization functions)

    // Fetch email from POST
    $email = $_POST['email'];

    // Check if the email already exists in the database
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

    // Check if the email already exists
    if ($row['count'] > 0) {
        // Email already exists, handle the error
        $email_exists_error = "البريد الإلكتروني مسجل بالفعل!";
        $_SESSION['error_message'] = $email_exists_error;

        // Redirect back to the form with error message
        header('Location: ../dist/createAccount.php');
        exit();
    }

    // If email doesn't exist, proceed with user insertion
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $role = $_POST['role'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Prepare INSERT statement
    $stmt = $conn->prepare("INSERT INTO users (email, firstname, lastname, gender, age, role, phone_number, password, security_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // You should generate a secure password hash, this is just an example
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Assuming security_code is another field you need to insert, adjust as per your needs
    $security_code = ""; // Set your security code here

    $stmt->bind_param("ssssissss", $email, $firstname, $lastname, $gender, $age, $role, $phone_number, $hashed_password, $security_code);

    if ($stmt->execute() === FALSE) {
        die("Error executing statement: " . $stmt->error);
    } else {
        echo "User inserted successfully!";
    }

    $conn->close();

    // Redirect to index page after successful insertion
    header('Location: ../dist/index.php');
    exit();
}
?>
