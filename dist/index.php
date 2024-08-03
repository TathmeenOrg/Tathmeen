<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <?php
    include ('../database/config.php');
    session_start();

    // تحقق من تسجيل الدخول
    if (!isset($_SESSION['user_id'])) {
        header("Location: auth-login.php");
        exit();
    }

    //عدد الحسابات
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = $conn->query($sql);

    $count = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
    }

    //الجنس حق اليوزر الحالي
    $sql2 = "SELECT gender FROM `users` WHERE id = " . $_SESSION['user_id'] . "";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
        $_SESSION['user_gender'] = $row2['gender'];
    }



    //الاسم حق اليوزر الحالي
    $sql3 = "SELECT firstname, lastname FROM users WHERE id = " . $_SESSION['user_id'] . "";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {
        $row3 = $result3->fetch_assoc();
        $_SESSION['user_name'] = $row3['firstname'] . ' ' . $row3['lastname'];
    }

    //اسم الصفحه حاليّا
    $current_page = basename($_SERVER['PHP_SELF']);



    //متوسط سعر العروض المالية 
    $user_id = $_SESSION['user_id'];
    $query_role = "SELECT role FROM users WHERE id = ?";
    $stmt_role = $conn->prepare($query_role);
    $stmt_role->bind_param("i", $user_id);
    $stmt_role->execute();
    $result_role = $stmt_role->get_result();

    $user_role = '';
    if ($result_role->num_rows > 0) {
        $row_role = $result_role->fetch_assoc();
        $user_role = $row_role['role'];
    }

    $stmt_role->close();

    if ($user_role == 'super_admin') {
        $query = "SELECT AVG(total_price) as average_price FROM financialoffers";
    } else if ($user_role == 'sub_admin') {
        $query = "SELECT AVG(total_price) as average_price FROM financialoffers WHERE user_id = ?";
    }

    $stmt = $conn->prepare($query);

    if ($user_role == 'sub_admin') {
        $stmt->bind_param("i", $user_id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $average_price = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $average_price = $row['average_price'];
    }

    $stmt->close();

    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | الصفحة الرئيسية</title>
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
    <style>
        #buttonCreateOffer:hover {
            background-color: #f0f0f0;
            border-radius: .7rem;
            cursor: pointer;
        }

        #buttonCreateUser:hover {
            background-color: #f0f0f0;
            border-radius: .7rem;
            cursor: pointer;
        }

        #buttonCreateOffer a {
            color: inherit;
            text-decoration: none;
            display: block;
        }

        #buttonCreateUser a {
            color: inherit;
            text-decoration: none;
            display: block;
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
                        <?php if ($_SESSION['user_role'] === 'super_admin'): ?>
                            <li id='account_management'
                                class='sidebar-item <?= $current_page == 'account_management.php' ? 'active' : '' ?>'>
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

                        <?php if ($_SESSION['user_role'] === 'super_admin'): ?>
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

            <?php
            echo "<div class='page-heading'>";
            echo "<h3>مرحبًا " . $_SESSION['user_name'] . " !</h3>";
            echo "</div>";
            ?>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldLogin"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">عدد مرات تسجيل الدخول</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php echo isset($_SESSION['user_login_count']) ? $_SESSION['user_login_count'] : 'N/A'; ?>
                                                </h6>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">عدد الحسابات   </h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $count; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldWallet"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">متوسط أسعار العروض المالية </h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php
                                                    if (is_numeric($average_price)) { 
                                                        // Not Null
                                                        echo number_format($average_price, 2) . " ريال";
                                                    } else { 
                                                        // Null
                                                        echo "0.00 ريال";
                                                    }
                                                    ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>عدد العروض المالية الصادرة </h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php if ($_SESSION['user_role'] === 'super_admin'): ?>
                                <div class="col-6 col-lg-6 col-md-6">
                                    <div class="card">
                                        <a href="createAccount.php">
                                            <div class="card-body px-3 py-4-5" id="buttonCreateUser">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="stats-icon green">
                                                            <i class="iconly-boldAdd-User"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10" style="padding: 0.5rem 1.0rem;">
                                                        <h6 class="text-muted font-semibold" style="font-size: large;">إنشاء
                                                            حساب مستخدم جديد</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-6 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5" id="buttonCreateOffer">
                                        <a href="financialOffersForm.php ">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="stats-icon purple">
                                                        <i class="iconly-boldPaper-Plus"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-10" style="padding: 0.5rem 1.0rem;">
                                                    <h6 class="text-muted font-semibold" style="font-size: large;">إضافة
                                                        عرض مالي جديد</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <?php
                                echo "<div class='d-flex align-items-center'>";
                                if ($_SESSION['user_gender'] == 'female') {
                                    echo "<div class='avatar avatar-xl'>";
                                    echo "<img src='assets/images/faces/3.jpg' alt='Face 3'>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='avatar avatar-xl'>";
                                    echo "<img src='assets/images/faces/2.jpg' alt='Face 2'>";
                                    echo "</div>";
                                }
                                echo "<div class='ms-3 name' style='padding-right: 10px;'>";
                                echo "<h5 class='font-bold'>" . $_SESSION['user_name'] . "</h5>";
                                echo "<h6 class='text-muted mb-0'>" . $_SESSION['user_role'] ."@</h6>";
                                echo "</div>";
                                echo "</div>";
                                ?>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>المستخدمين</h4>
                            </div>
                            <div class="card-content pb-4">
                                <?php

                                $sql = "SELECT * FROM users";
                                $result = $conn->query($sql);

                                $users = [];
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $users[] = $row;
                                    }
                                } else {
                                    echo "<p>لا يوجد مستخدمين لعرضهم</p>";
                                }
                                // Display first 4 users
                                for ($i = 0; $i < min(3, count($users)); $i++) {
                                    $row = $users[$i];
                                    $avatarImage = ($row['gender'] == 'female') ? 'assets/images/faces/3.jpg' : 'assets/images/faces/2.jpg';

                                    echo "<div class='recent-message d-flex px-4 py-3'>";
                                    echo "<div class='avatar avatar-lg'>";
                                    echo "<img src='" . $avatarImage . "' alt='Avatar'>";
                                    echo "</div>";
                                    echo "<div class='name ms-4' style='padding-right: 10px;'>";
                                    echo "<h6 class='mb-1'>" . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) . "</h6>";
                                    echo "<h6 class='text-muted mb-0'>" . htmlspecialchars($row['role']) . "</h6>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                ?>
                                <div class="px-4">
                                    <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'
                                        data-bs-toggle="modal" data-bs-target="#allUsersModal">عرض الكل</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>تصنيف المستخدمين </h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>




            <!-- Modal -->
            <div class="modal fade" id="allUsersModal" tabindex="-1" aria-labelledby="allUsersModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header  ">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <h5 class="modal-title" id="allUsersModalLabel">جميع المستخدمين</h5>
                        </div>


                        <div class="modal-body">
                            <?php
                         
                            foreach ($users as $row) {
                                $avatarImage = ($row['gender'] == 'female') ? 'assets/images/faces/3.jpg' : 'assets/images/faces/2.jpg';

                                echo "<div class='recent-message d-flex px-4 py-3'>";
                                echo "<div class='avatar avatar-lg'>";
                                echo "<img src='" . $avatarImage . "' alt='Avatar'>";
                                echo "</div>";
                                echo "<div class='name ms-4' style='padding-right: 10px;'>";
                                echo "<h5 class='mb-1'>" . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) . "</h5>";
                                echo "<h6 class='text-muted mb-0'>" . htmlspecialchars($row['role']) . "</h6>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
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


    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>

</body>

</html>