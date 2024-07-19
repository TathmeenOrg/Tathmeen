<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | تسجيل الدخول</title>
    <link rel="icon" href="assets/images/logo/tathmeen_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
                    <h1 class="auth-title">تسجيل الدخول</h1>
                    <p class="auth-subtitle mb-5">قم بتسجيل الدخول ببياناتك التي قمت بإدخالها أثناء التسجيل.</p>

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


                    <form novalidate action="login.php" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" id="email" class="form-control form-control-xl" placeholder="البريد الالكتروني" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" id="password" class="form-control form-control-xl" placeholder="كلمة المرور" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">تسجيل الدخول</button>
                    </form>
                    <div class="text-center mt-4 text-lg fs-5">
                        <p><a href="auth-forgot-password.php">نسيت كلمة المرور؟</a></p>
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