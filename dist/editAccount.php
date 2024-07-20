<?php
include('../database/config.php');
session_start();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $user_id = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result(); 

    $user = $result->fetch_assoc();
    $stmt->close();
} else {
  
    echo "id المستخدم غير صالح أو مفقود.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | تعديل حساب </title>
    <link rel="icon" href="assets/images/logo/tathmeen_logo.png">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/bootstrap.css">


<link rel="stylesheet" href="assets/vendors/iconly/bold.css">

<link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
<link rel="stylesheet" href="assets/css/app.css">
<link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-buttons {
            display: flex;
            align-items: center;
        }

        .card-title {
            margin-bottom: 0;
        }

        #editIcon {
            font-size: 1em;
            padding: 0.63em;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

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
                            <h3>نموذج تعديل حساب مسجل في نظام تثمين  </h3>
                            <p class="text-subtitle text-muted"> معلومات التعديل  </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسة</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">تعديل حساب </li>
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
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">تعديل حساب</h4>
                                        <div class="action-buttons d-flex align-items-center">
                                            <button class="btn btn-warning edit-btn ms-3" id="editIcon">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <a href="account_management.php" class="btn btn-danger ms-3">إلغاء</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="editForm" method="POST" action="../database/update.php" novalidate>
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
                                                                            value="<?php echo $user['firstname']; ?>"
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
                                                                            value="<?php echo $user['lastname']; ?>"
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
                                                                            value="<?php echo $user['email']; ?>"
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
                                                                        <label class="col-form-label">الدور <span
                                                                                style="color: red;">*</span></label>
                                                                        <div class="col-md-10 mb-4">
                                                                            <select class="form-select" id="role"
                                                                                name="role" required>
                                                                                <option value="" disabled>اختر الدور
                                                                                </option>
                                                                                <option value="super_admin" <?php
                                                                                    if($user['role']=='super_admin' )
                                                                                    echo 'selected' ; ?>>مسؤول</option>
                                                                                <option value="sub_admin" <?php
                                                                                    if($user['role']=='sub_admin' )
                                                                                    echo 'selected' ; ?>>مستخدم</option>
                                                                            </select>
                                                                            <div id="error-role"
                                                                                class="invalid-feedback"></div>
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
                                                                            <option value="" disabled>اختر الجنس
                                                                            </option>
                                                                            <option value="female" <?php
                                                                                if($user['gender']=='female' )
                                                                                echo 'selected' ; ?>>أنثى</option>
                                                                            <option value="male" <?php
                                                                                if($user['gender']=='male' )
                                                                                echo 'selected' ; ?>>ذكر</option>
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
                                                                            value="<?php echo $user['age']; ?>"
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
                                                                            value="<?php echo $user['phone_number']; ?>"
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
                                                    <button type="submit" name="updateAccount"
                                                        class="btn btn-lg btn-primary rounded-pill mx-2">حفظ التعديلات
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>

            </div>

        </div>

        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header btn-success">

                                <h5 class="modal-title  " id="successModalLabel"  style="color: beige;"> تأكيد </h5>

                            </div>
                            <div class="modal-body">
                                تم تعديل الحساب بنجاح
                            </div>
                            <div class="modal-footer">
                                <a href="index.php" class="btn btn-success"> العودة للصفحة الرئيسة </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

   
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title" id="logoutModalLabel">تأكيد تسجيل الخروج</h5>

                </div>
                <div class="modal-body">
                    هل أنت متأكد من أنك تريد تسجيل الخروج؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <a href="logout.php" class="btn btn-danger">تسجيل الخروج</a>
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
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                        href="http://ahmadsaugi.com">A. Saugi</a></p>
            </div>
        </div>
    </footer>
    </div>
    </div>
    <script>


document.getElementById('editForm').addEventListener('submit', function (event) {
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

    // Check email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        valid = false;
        email.classList.add('is-invalid');
        document.getElementById('error-email').textContent = 'الرجاء إدخال البريد الإلكتروني.';
    } else if (!emailPattern.test(email.value)) {
        valid = false;
        email.classList.add('is-invalid');
        document.getElementById('error-email').textContent = 'الرجاء إدخال بريد إلكتروني صالح.';
    }

    // Check password
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!password.value.trim()) {
        valid = false;
        password.classList.add('is-invalid');
        document.getElementById('error-password').textContent = 'الرجاء إدخال كلمة المرور.';
    } else if (!passwordPattern.test(password.value)) {
        valid = false;
        password.classList.add('is-invalid');
        document.getElementById('error-password').textContent = 'يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل وتضم أحرفاً كبيرة وصغيرة وأرقاماً.';
    }

    // Check role
    if (!role.value.trim()) {
        valid = false;
        role.classList.add('is-invalid');
        document.getElementById('error-role').textContent = 'الرجاء اختيار الدور.';
    }

    // Check gender
    if (!gender.value.trim()) {
        valid = false;
        gender.classList.add('is-invalid');
        document.getElementById('error-gender').textContent = 'الرجاء اختيار الجنس.';
    }

    // Check age
    if (!age.value.trim()) {
        valid = false;
        age.classList.add('is-invalid');
        document.getElementById('error-age').textContent = 'الرجاء إدخال العمر.';
    } else if (parseInt(age.value) < 0) {
        valid = false;
        age.classList.add('is-invalid');
        document.getElementById('error-age').textContent = 'العمر يجب أن يكون قيمة موجبة.';
    }

    // Check phone number
    const phonePattern = /^[0-9]{10}$/;
    if (!phone.value.trim()) {
        valid = false;
        phone.classList.add('is-invalid');
        document.getElementById('error-phone').textContent = 'الرجاء إدخال رقم الجوال.';
    } else if (!phonePattern.test(phone.value)) {
        valid = false;
        phone.classList.add('is-invalid');
        document.getElementById('error-phone').textContent = 'الرجاء إدخال رقم جوال صالح.';
    }

    // If email is valid, check if it already exists
    if (valid) {
        checkEmailExists(email.value, function (exists) {
            if (exists && email.value !== email) {
                valid = false;
                email.classList.add('is-invalid');
                document.getElementById('error-email').textContent = 'البريد الإلكتروني مستخدم بالفعل.';
            }

            // If all validations pass, submit the form
            if (valid) {
                submitForm();
            }
        });
    }
});

function submitForm() {
    const formData = new FormData(document.getElementById('editForm'));
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../database/update.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            $('#successModal').modal('show');
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 2000);
        } else {
            console.error('Error submitting form: ' + xhr.statusText);
        }
    };
    xhr.send(formData);
}

function checkEmailExists(email, callback) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../database/checkEmail2.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            callback(response.exists);
        } else {
            console.error('Error checking email: ' + xhr.statusText);
            callback(false);
        }
    };
    xhr.send(`email=${encodeURIComponent(email)}`);
}

</script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const form = document.getElementById('editForm');
            const editIcon = document.getElementById('editIcon');
            const formElements = form.elements;

            function toggleForm(disabled) {
                for (let i = 0; i < formElements.length; i++) {
                    formElements[i].disabled = disabled;
                }
            }


            toggleForm(true);


            editIcon.addEventListener('click', () => {
                toggleForm(false);
            });
        });
    </script>


    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>