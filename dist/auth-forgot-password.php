<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | نسيت كلمة المرور</title>
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
                        <a href="index.php"><img src="assets/images/logo/logo.png" style="height: 6rem;" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">نسيت كلمة المرور</h1>
                    <p class="auth-subtitle mb-5">أدخل بريدك الإلكتروني وسيتم إرسال رابط لإعادة تعيين كلمة المرور</p>
                    
                    <?php
                    session_start();
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
                    <?php
                    if (isset($_POST['sendResetPassword'])) {
                        if (empty($_POST['email'])) {
                            $_SESSION['alert_type'] = 'warning';
                            $_SESSION['alert_message'] = 'الرجاء إدخال البريد الإلكتروني.';
                            header("Location: auth-forgot-password.php");
                            exit();
                        }
                    }
                    ?>
                    <form novalidate method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" placeholder="البريد الإلكتروني" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <button type="submit" name="sendResetPassword" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">إرسـال رابط إعادة تعيين كلمة المرور</button>
                    </form>

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendResetPassword']) && !empty($_POST['email'])) {
                        $username = "root";
                        $password = "12345678";
                        $database = new PDO("mysql:host=127.0.0.1;dbname=Tathmeen;charset=utf8", $username, $password);

                        $checkEmail = $database->prepare("SELECT email FROM users WHERE email = :email");
                        $checkEmail->bindParam(":email", $_POST['email']);
                        $checkEmail->execute();

                        if ($checkEmail->rowCount() > 0) {
                            require_once 'mail.php';
                            $user = $checkEmail->fetchObject();

                            // توليد رمز عشوائي
                            $security_code = bin2hex(random_bytes(16));

                            // تحديث الرمز في الداتابيس
                            $updateCode = $database->prepare("UPDATE users SET security_code = :security_code WHERE email = :email");
                            $updateCode->bindParam(":security_code", $security_code);
                            $updateCode->bindParam(":email", $_POST['email']);
                            $updateCode->execute();

                            // إرسال الايميل
                            $mail->addAddress($_POST['email']);
                            $mail->Subject = "رسالة خاصة بإعادة تعييد كلمة المرور";
                            $mail->Body = '
                            رابط إعادة تعيين كلمة المرور
                            </br>
                            ' . '<a href="http://localhost:8888/Tathmeen/dist/reset-password.php?email=' . $_POST['email'] . '&code=' . $security_code . '">http://localhost:8888/Tathmeen/dist/reset-password.php?email=' . $_POST['email'] . '&code=' . $security_code . '</a>';
                            $mail->setFrom('manar.al.mashi.2003@gmail.com', 'نظام تثمين | عون التقنية');
                            $mail->send();
                            $_SESSION['alert_type'] = 'success';
                            $_SESSION['alert_message'] = 'تم ارسال رابط اعادة تعيين كلمة المرور بنجاح!!!';
                        } else {
                            $_SESSION['alert_type'] = 'danger';
                            $_SESSION['alert_message'] = 'هذا البريد غير مسجل في نظام تثمين!';
                        }

                        // إغلاق الاتصال بالداتابيس
                        $database = null;

                        // إعادة توجيه المستخدم بعد معالجة النموذج
                        header("Location: auth-forgot-password.php");
                        exit();
                    }
                    ?>
                    <div class="text-center mt-5 text-lg fs-5">
                        <p class='text-gray-600'>تتذكّر كلمة المرور ؟<a href="auth-login.php" class="font-bold">سجّـل دخول</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

</body>
</html>
