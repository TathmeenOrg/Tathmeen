<?php
include('../database/config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // التحقق من أن الحقول ليست فارغة
    if (empty($_POST['email'])) {
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_message'] = 'الرجاء إدخال البريد الإلكتروني.';
        header("Location: auth-login.php");
        exit();
    } elseif (empty($_POST['password'])) {
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_message'] = 'الرجاء إدخال كلمة المرور.';
        header("Location: auth-login.php");
        exit();
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        //اخذ المستخدم من الداتابيس
        $sql = "SELECT `id`, `email`, `role`, `phone_number`, `firstname`, `password` FROM `users` WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // التحقق من الباسوورد
            if ($password == $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['name'];

                $_SESSION['alert_type'] = 'success';
                $_SESSION['alert_message'] = 'تم تسجيل الدخول بنجاح!';
                
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['alert_type'] = 'danger';
                $_SESSION['alert_message'] = 'كلمة المرور غير صحيحة.';
            }
        } else {
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_message'] = 'البريد الإلكتروني غير موجود.';
        }

        $stmt->close();
    }
    header("Location: auth-login.php");
    exit();
}
$conn->close();
?>
