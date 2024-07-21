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
        $sql = "SELECT id, email, firstname, lastname, gender, role, phone_number, password  ,`login_count` FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // التحقق من كلمة المرور
            if ($password == $user['password']) {
                // تسجيل الدخول بنجاح
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_login_count'] = $user['login_count'];

                // التحقق من وجود login_count
                if (isset($user['login_count'])) {
                    // تسجيل عدد مرات تسجيل الدخول الحالي
                    echo "Current login count: " . $user['login_count'] . "<br>";

                    // زيادة عدد مرات تسجيل الدخول
                    $new_login_count = $user['login_count'] + 1;

                    // تحديث عدد مرات تسجيل الدخول في قاعدة البيانات
                    $update_login_count_sql = "UPDATE users SET login_count = ? WHERE id = ?";
                    $stmt_update = $conn->prepare($update_login_count_sql);
                    $stmt_update->bind_param("ii", $new_login_count, $user['id']);
                    $stmt_update->execute();
                    $stmt_update->close();

                    // تسجيل عدد مرات تسجيل الدخول بعد التحديث
                    echo "Updated login count to: " . $new_login_count . "<br>";

               
                    header("Location: index.php");
                    exit();
                }
    
            }
       
        else {
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
