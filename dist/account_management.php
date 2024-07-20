<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | إدارة الحسابات</title>
    <link rel="icon" href="assets/images/logo/tathmeen_logo.png">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <?php
    include('../database/config.php');
    session_start();

    // تحقق من تسجيل الدخول
    if (!isset($_SESSION['user_id'])) {
        header("Location: auth-login.php");
        exit();
    }

    // تحقق من دور المستخدم
    if ($_SESSION['user_role'] !== 'super_admin') {
        header("Location: error-403.html");
        exit();
    }

    // جيب كل اليوزرز
    $sql = "SELECT `id`, `fristname`, `email`, `role`, `phone_number` FROM `users`";
    $result = $conn->query($sql);

    //عملية حذف المستخدم
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);

        // ١- حذف الخدمات المرتبطة بالمستخدم
        $delete_services_sql = "DELETE FROM `services` WHERE `user_id` = ?";
        $delete_services_sql = $conn->prepare($delete_services_sql);
        $delete_services_sql->bind_param("i", $delete_id);
        $delete_services_sql->execute();
        $delete_services_sql->close();

        // ٢- حذف العروض المالية المرتبطة بالمستخدم
        $delete_offers_sql = "DELETE FROM `financialoffers` WHERE `user_id` = ?";
        $delete_offers_stmt = $conn->prepare($delete_offers_sql);
        $delete_offers_stmt->bind_param("i", $delete_id);
        $delete_offers_stmt->execute();
        $delete_offers_stmt->close();

        // ٣- حذف المستخدم
        $delete_sql = "DELETE FROM `users` WHERE `id` = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $delete_id);
        $delete_stmt->execute();
        $delete_stmt->close();

        header("Location: account_management.php");
        exit();
    }
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
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
                            <li id='account_management' class='sidebar-item <?= $current_page == 'account_management.php' ? 'active' : '' ?>'>
                                <a href='account_management.php' class='sidebar-link'>
                                    <i class='bi bi-person-square'></i>
                                    <span>إدارة الحسابات</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="sidebar-item <?= $current_page == 'financial_offers_management.php' ? 'active' : '' ?>">
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
                            <li class='sidebar-item <?= $current_page == 'company-information-form.php' ? 'active' : '' ?>'>
                                <a href='company-information-form.php' class='sidebar-link'>
                                    <i class='bi bi-info-circle-fill'></i>
                                    <span>إدارة معلومات الشركة</span>
                                </a>
                            </li>
                            <li class='sidebar-item <?= $current_page == 'statementForm.php' ? 'active' : '' ?>'>
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
                            <h3>إدارة الحسابات</h3>
                            <p class="text-subtitle text-muted">جميع حسابات مستخدمين نظام تثمين sub_admin أو super_admin..</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start ">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسية</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">إدارة الحسابات</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Hoverable rows start -->
                <section class="section">
                    <!-- <div class="row" id="table-hover-row"> -->
                    <!-- <div class="col-12"> -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-md-10 order-md-1 order-last">
                                    <h4 class="card-title">قائمة المستخدمين</h4>
                                </div>
                                <div class="col-12 col-md-2 order-md-2 order-first">
                                    <button type="button" class="btn btn-primary" onclick="window.location.href='createAccount.php'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                        </svg>
                                        إضافة مستخدم جديد
                                    </button>
                                </div>
                            </div>



                            <!-- <h4 class="card-title">قائمة المستخدمين</h4> -->
                        </div>
                        <div class="card-body">
                            <!-- <div class="table-responsive"> -->
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>الرقم</th>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الدور</th>
                                        <th>رقم الهاتف</th>
                                        <th>الإجراء</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $serial_number = 1;
                                    if ($result->num_rows > 0) {
                                        while ($user = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$serial_number}</td>";
                                            echo "<td class='text-bold-500'>{$user['name']}</td>";
                                            echo "<td>{$user['email']}</td>";
                                            echo "<td>{$user['role']}</td>";
                                            echo "<td>{$user['phone_number']}</td>";
                                            echo '<td>
                                                        <a href="#" class="btn btn-outline-danger ms-1" onclick="confirmDelete(' . $user['id'] . ')" data-bs-toggle="modal" data-bs-target="#dangerModal">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2-fill" viewBox="0 0 16 16">
                                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                            </svg>
                                                        </a>
                                                        <a href="editAccount.php" class="btn btn-outline-warning ms-1" data-bs-toggle="modal" data-bs-target="#dangerWarning">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"></path>
                                                            </svg>
                                                        </a>
                                                        </td>';
                                            echo "</tr>";
                                            $serial_number++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' style='text-align: center; color: #d63384'>لا يوجد مستخدمين حاليًّا في النظام.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- </div> -->
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                </section>
                <!-- Hoverable rows end -->
            </div>

            <!--Danger theme Modal -->
            <div class="modal fade" id="dangerModal" tabindex="-1" role="dialog" aria-labelledby="dangerModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title text-white" id="dangerModalLabel">هل أنت متأكد ؟</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            سيتم حذف هذا المستخدم نهائيًّا من النظام مع جميع العروض المالية والخدمات الخاصة به.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <a href="#" id="confirmDeleteBtn" class="btn btn-danger" onclick="deleteUser()">متأكد</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Logout Modal -->
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
                        <p>2024 &copy; نظام تثمين</p>
                    </div>
                    <div class="float-end">
                        <p>جميع حقوق الملكية محفوظة</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script>
        let userIdToDelete;

        function confirmDelete(userId) {
            userIdToDelete = userId;
        }

        function deleteUser() {
            window.location.href = "account_management.php?delete_id=" + userIdToDelete;
        }
    </script>
</body>

</html>