<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $email = $_POST['email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // التحقق من كلمة المرور انها مو فاضيه
    if (empty($new_password)) {
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_message'] = 'الرجاء إدخال كلمة المرور الجديدة.';
        header("Location: reset-password.php?code=$token&email=$email");
        exit();
    }

    // التحقق من شروط كلمة المرور
    if (!preg_match('/[A-Z]/', $new_password)) {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'كلمة المرور يجب أن تحتوي على حرف إنجليزي كبير واحد على الأقل.';
        header("Location: reset-password.php?code=$token&email=$email");
        exit();
    }

    if (!preg_match('/[a-z]/', $new_password)) {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'كلمة المرور يجب أن تحتوي على حرف إنجليزي صغير واحد على الأقل.';
        header("Location: reset-password.php?code=$token&email=$email");
        exit();
    }

    if (!preg_match('/\d/', $new_password)) {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'كلمة المرور يجب أن تحتوي على رقم واحد على الأقل.';
        header("Location: reset-password.php?code=$token&email=$email");
        exit();
    }

    if (strlen($new_password) <= 8) {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'كلمة المرور يجب أن تكون أطول من 8 أحرف.';
        header("Location: reset-password.php?code=$token&email=$email");
        exit();
    }

    //التحقق من تأكيد كلمة المرور انها مو فاضيه
    if (empty($confirm_password)) {
        $_SESSION['alert_type'] = 'warning';
        $_SESSION['alert_message'] = 'الرجاء إدخال تأكيد كلمة المرور الجديدة.';
        header("Location: reset-password.php?code=$token&email=$email");
        exit();
    }

    // التحقق من كلمة المرور وتأكيد كلمة المرور متطابقين
    if ($new_password !== $confirm_password) {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'كلمة المرور وتأكيد كلمة المرور غير متطابقين.';
        header("Location: reset-password.php?code=$token&email=$email");
        exit();
    }

    try {
        $username = "root";
        $password = "12345678";
        $database = new PDO("mysql:host=127.0.0.1;dbname=tathmeen;charset=utf8", $username, $password);

        // تحقق من الرمز والبريد الإلكتروني
        $checkToken = $database->prepare("SELECT * FROM users WHERE email = :email AND security_code = :security_code");
        $checkToken->bindParam(":email", $email);
        $checkToken->bindParam(":security_code", $token);
        $checkToken->execute();

        if ($checkToken->rowCount() > 0) {
            // تحديث كلمة المرور وإزالة الرمز
            $updatePassword = $database->prepare("UPDATE users SET password = :password, security_code = NULL WHERE email = :email");
            $updatePassword->bindParam(":password", $new_password);
            $updatePassword->bindParam(":email", $email);
            $updatePassword->execute();

            $_SESSION['alert_type'] = 'success';
            $_SESSION['alert_message'] = 'تم إعادة تعيين كلمة المرور بنجاح.';
        } else {
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_message'] = 'رمز إعادة تعيين غير صالح.';
        }

        // إغلاق الاتصال بقاعدة البيانات
        $database = null;

        // إعادة توجيه المستخدم لعرض رسالة التنبيه
        header("Location: reset-password.php?code=$token&email=$email&success=1");
        exit();
    } catch (PDOException $e) {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'خطأ في الاتصال بقاعدة البيانات: ' . $e->getMessage();

        // إعادة توجيه المستخدم لعرض رسالة التنبيه
        header("Location: reset-password.php?code=$token&email=$email");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | إعادة تعيين كلمة المرور</title>
    <link rel="icon" href="assets/images/logo/tathmeen_logo.png">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
</head>

<body>
    <div id="auth" style="font-family: 'Cairo', sans-serif;">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.php"><img src="assets/images/logo/logo.png" style="height: 5rem;" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">إعادة تعيين كلمة المرور</h1>
                    <p class="auth-subtitle mb-5">أدخل كلمة المرور الجديدة.</p>

                    <?php
                    $isSuccess = isset($_GET['success']) && $_GET['success'] === '1';
                    if (isset($_SESSION['alert_message'])) {
                        $alert_type = isset($_SESSION['alert_type']) ? $_SESSION['alert_type'] : 'warning';

                        $icon_class = 'exclamation-triangle';
                        if ($alert_type === 'warning') {
                            $icon_class = 'exclamation-triangle';
                        } elseif ($alert_type === 'success') {
                            $icon_class = 'check-circle';
                        } elseif ($alert_type === 'danger') {
                            $icon_class = 'exclamation-circle';
                        }

                        echo '<div class="alert alert-' . $alert_type . '"><i class="bi bi-' . $icon_class . '"></i> ' . $_SESSION['alert_message'] . '</div>';

                        unset($_SESSION['alert_message']);
                        unset($_SESSION['alert_type']);
                    }
                    ?>

                    <form id="reset-form" novalidate action="" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['code']); ?>">
                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
                            <input type="password" name="password" id="password" class="form-control form-control-xl" placeholder="كلمة المرور الجديدة" required>
                            <div class="form-control-icon" id="togglePassword">
                                <i class="bi bi-eye-slash"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-xl" placeholder="تأكيد كلمة المرور الجديدة" required>
                            <div class="form-control-icon" id="toggleConfirmPassword">
                                <i class="bi bi-eye-slash"></i>
                            </div>
                        </div>
                        <button name="resetPassword" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">حفظ كلمة المرور</button>
                    </form>

                    <div id="success-message" class="text-center mt-4 text-lg fs-5" style="display: none;">
                        <p><a href="auth-login.php">تسجيل الدخول الآن</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isSuccess = new URLSearchParams(window.location.search).get('success') === '1';
            const form = document.getElementById('reset-form');
            const successMessage = document.getElementById('success-message');

            if (isSuccess) {
                form.style.display = 'none';
                successMessage.style.display = 'block';
            } else {
                successMessage.style.display = 'none';
            }

            const togglePassword = document.querySelector('#togglePassword');
            const passwordField = document.querySelector('#password');
            const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
            const confirmPasswordField = document.querySelector('#confirm_password');

            togglePassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Toggle the icon class
                this.querySelector('i').classList.toggle('bi-eye-slash');
                this.querySelector('i').classList.toggle('bi-eye');
            });

            toggleConfirmPassword.addEventListener('click', function() {
                // Toggle the type attribute
                const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordField.setAttribute('type', type);

                // Toggle the icon class
                this.querySelector('i').classList.toggle('bi-eye-slash');
                this.querySelector('i').classList.toggle('bi-eye');
            });
        });
    </script>

</body>

</html>