<?php
    include('../database/config.php');
    session_start();
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | إنشاء حساب </title>
    <link rel="icon" href="assets/images/logo/tathmeen_logo.png">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .card {
            width: 70%;
            max-width: 100%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div id="app">

        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">القائمة</li>

                        <li class="sidebar-item <?= $current_page == 'index.php' ? 'active' : '' ?>">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>الصفحة الرئيسية</span>
                            </a>
                        </li>

                        <li class="sidebar-title">قسم الإدارات</li>
                        <?php if ($_SESSION['user_role'] === 'super_admin') : ?>
                        <li id='account_management' class='sidebar-item <?= $current_page == ' account_management.php'
                            ? 'active' : '' ?>'>
                            <a href='account_management.php' class='sidebar-link'>
                                <i class='bi bi-person-square'></i>
                                <span>إدارة الحسابات</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <li
                            class="sidebar-item <?= $current_page == 'financial_offers_management.php' ? 'active' : '' ?>">
                            <a href="financial_offers_management.php" class='sidebar-link'>
                                <i class="bi bi-briefcase-fill"></i>
                                <span>إدارة العروض المالية</span>
                            </a>
                        </li>

                        <li class="sidebar-title">قسم الملفات</li>

                        <li class="sidebar-item <?= $current_page == 'fileview.php' ? 'active' : '' ?>">
                            <a href="fileview.php" class='sidebar-link'>
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                                <span>عرض الملفات</span>
                            </a>
                        </li>

                        <?php if ($_SESSION['user_role'] === 'super_admin') : ?>
                        <li class='sidebar-title'>قسم إدارة الشركة</li>
                        <li class='sidebar-item <?= $current_page == ' company-information-form.php' ? 'active' : '' ?>
                            '>
                            <a href='company-information-form.php' class='sidebar-link'>
                                <i class='bi bi-info-circle-fill'></i>
                                <span>إدارة معلومات الشركة</span>
                            </a>
                        </li>
                        <li class='sidebar-item <?= $current_page == ' statementForm.php' ? 'active' : '' ?>'>
                            <a href='statementForm.php' class='sidebar-link'>
                                <i class='bi bi-file-earmark-spreadsheet-fill'></i>
                                <span>إدارة بيان العروض المالية</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <li class="sidebar-item" style="margin-top: 80px;">
                            <a href="#" class='sidebar-link' data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="iconly-boldLogout" style="color: #d63384;"></i>
                                <span style='color: #d63384;'>تسجيل خروج</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>





        <div id="main" style="font-family: 'Cairo', sans-serif;">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>نموذج إنشاء حساب جديد</h3>
                            <p class="text-subtitle text-muted">إضافة حساب</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الصفحة الرئيسة</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">إنشاء حساب جديد</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <section id="horizontal-input">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">إنشاء حساب جديد</h4>
                                    </div>
                                    <form id="CreateForm" novalidate method="POST"
                                        action="../database/CreateAccountDB.php">
                                        <div class="card-body">

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            <i class="bi bi-person-circle"></i> المعلومات الشخصية
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">الاسم الأول <span
                                                                                style="color: red;">*</span></label>
                                                                        <input type="text" id="firstname"
                                                                            class="form-control" name="firstname"
                                                                            placeholder="First Name">
                                                                        <div id="error-first-name"
                                                                            class="invalid-feedback"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">الاسم الأخير <span
                                                                                style="color: red;">*</span></label>
                                                                        <input type="text" id="lastname"
                                                                            class="form-control" name="lastname"
                                                                            placeholder="Last Name">
                                                                        <div id="error-last-name"
                                                                            class="invalid-feedback"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="true" aria-controls="collapseTwo">
                                                            <i class="bi bi-gear"></i> معلومات الحساب
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">البريد الإلكتروني
                                                                            <span style="color: red;">*</span></label>
                                                                        <input type="email" id="email"
                                                                            class="form-control" name="email"
                                                                            placeholder="Email">
                                                                        <div id="error-email" class="invalid-feedback">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">كلمة المرور <span
                                                                                style="color: red;">*</span></label>
                                                                        <input type="password" id="password"
                                                                            class="form-control" name="password"
                                                                            placeholder="Password">
                                                                        <div id="error-password"
                                                                            class="invalid-feedback"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">الدور<span
                                                                                style="color: red;">*</span></label>

                                                                        <select class="form-select" id="role"
                                                                            name="role" required>
                                                                            <option value="" disabled selected>اختر
                                                                                الدور</option>
                                                                            <option value="super_admin">مسؤول
                                                                            </option>
                                                                            <option value="sub_admin">مستخدم
                                                                            </option>
                                                                        </select>
                                                                        <div id="error-role" class="invalid-feedback">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                            aria-expanded="true" aria-controls="collapseThree">
                                                            <i class="bi bi-info-circle"></i> معلومات إضافية
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingThree"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">الجنس <span
                                                                                style="color: red;">*</span></label>
                                                                        <select class="form-select" id="gender"
                                                                            name="gender" required>
                                                                            <option value="" disabled selected>اختر
                                                                                الجنس</option>
                                                                            <option value="female">أنثى</option>
                                                                            <option value="male">ذكر</option>
                                                                        </select>
                                                                        <div id="error-gender" class="invalid-feedback">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">العمر <span
                                                                                style="color: red;">*</span></label>
                                                                        <input type="number" id="age"
                                                                            class="form-control" name="age"
                                                                            placeholder="العمر" min="0"
                                                                            pattern="[0-9]*">
                                                                        <div id="error-age" class="invalid-feedback">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingFour">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                            aria-expanded="true" aria-controls="collapseFour">
                                                            <i class="bi bi-telephone"></i> معلومات الاتصال
                                                        </button>
                                                    </h2>
                                                    <div id="collapseFour" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingFour"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label">رقم الجوال <span
                                                                                style="color: red;">*</span></label>
                                                                        <input type="text" id="phone_number"
                                                                            class="form-control" name="phone_number"
                                                                            placeholder="Phone Number">
                                                                        <div id="error-phone" class="invalid-feedback">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>



                                                <br>
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" name="CreateAccount"
                                                        class="btn btn-lg btn-primary rounded-pill mx-2">إنشاء حساب
                                                    </button>
                                                </div>




                                            </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </section>
                </section>

                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header btn-success">

                                <h5 class="modal-title  " id="successModalLabel" style="color: beige;"> تأكيد </h5>

                            </div>
                            <div class="modal-body">
                                تم إنشاء الحساب بنجاح
                            </div>
                            <div class="modal-footer">
                                <a href="index.php" class="btn btn-success"> العودة للصفحة الرئيسة </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart hig"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        document.getElementById('CreateForm').addEventListener('submit', function (event) {
            event.preventDefault();
            let valid = true;

            const firstName = document.getElementById('firstname');
            const lastName = document.getElementById('lastname');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const role = document.getElementById('role');
            const gender = document.getElementById('gender');
            const age = document.getElementById('age');
            const phone = document.getElementById('phone_number');

            // Clear previous errors
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
            document.querySelectorAll('.form-control, .form-select').forEach(el => el.classList.remove('is-invalid'));

            // Check first name
            if (!firstName.value.trim()) {
                valid = false;
                firstName.classList.add('is-invalid');
                document.getElementById('error-first-name').textContent = 'الرجاء إدخال الاسم الأول.';
            }

            // Check last name
            if (!lastName.value.trim()) {
                valid = false;
                lastName.classList.add('is-invalid');
                document.getElementById('error-last-name').textContent = 'الرجاء إدخال الاسم الأخير.';
            }

            // Check email format
            if (!validateEmail(email.value)) {
                valid = false;
                email.classList.add('is-invalid');
                document.getElementById('error-email').textContent = 'الرجاء إدخال بريد إلكتروني صحيح.';
            } else {
                // Check email uniqueness using AJAX
                checkEmailAvailability(email.value, function (isUnique) {
                    if (!isUnique) {
                        valid = false;
                        email.classList.add('is-invalid');
                        document.getElementById('error-email').textContent = 'البريد الإلكتروني مسجل بالفعل.';
                    }
                    showSuccessModalIfValid(valid);
                });
            }

            // Check password
            if (password.value.length < 8 || !/\d/.test(password.value) || !/[A-Z]/.test(password.value) || !/[a-z]/.test(password.value)) {
                valid = false;
                password.classList.add('is-invalid');
                document.getElementById('error-password').textContent = 'كلمة المرور يجب أن تحتوي على حروف كبيرة وصغيرة وأرقام وأن يكون طولها 8 أحرف على الأقل.';
            }

            // Check role
            if (!role.value) {
                valid = false;
                role.classList.add('is-invalid');
                document.getElementById('error-role').textContent = 'الرجاء اختيار الدور.';
            }

            // Check gender
            if (!gender.value) {
                valid = false;
                gender.classList.add('is-invalid');
                document.getElementById('error-gender').textContent = 'الرجاء اختيار الجنس.';
            }

            // Check age
            if (!age.value || age.value <= 0) {
                valid = false;
                age.classList.add('is-invalid');
                document.getElementById('error-age').textContent = 'الرجاء إدخال عمر صحيح.';
            }

            // Check phone
            if (!validatePhoneNumber(phone.value)) {
                valid = false;
                phone.classList.add('is-invalid');
                document.getElementById('error-phone').textContent = 'الرجاء إدخال رقم جوال صحيح.';
            }

        });

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validatePhoneNumber(phone) {
            const re = /^\d{10}$/;
            return re.test(phone);
        }

        function checkEmailAvailability(email, callback) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../database/checkEmail.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    callback(!response.exists);
                } else {
                    console.error('Error checking email availability: ' + xhr.statusText);
                    callback(false);
                }
            };
            xhr.send('email=' + encodeURIComponent(email));
        }

        function showSuccessModalIfValid(valid) {
            if (valid) {
                $('#successModal').modal('show');
            }
        }

        document.querySelectorAll('.form-control, .form-select').forEach(input => {
            input.addEventListener('input', function () {
                if (this.classList.contains('is-invalid')) {
                    this.classList.remove('is-invalid');
                    document.getElementById(`error-${this.id}`).textContent = '';
                }
            });
        });


    </script>



    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>