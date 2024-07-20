<?php
include ('../database/config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | عرض ملفات العروض الماليه </title>
    <link rel="icon" href="assets/images/logo/tathmeen_logo.png">


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

  
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <style>
        .btn i {
            vertical-align: middle;

            position: relative;
            top: 4px;
        }

        .btn {
            line-height: 1.5;
            align-items: center;
        }

        .dataTable-cell,
        th {
            text-align: center;
        }

        .download-button {
            display: flex;
            justify-content: center;
            align-items: center;
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

                        <?php if ($_SESSION['user_role'] === 'super_admin'): ?>
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
                            <h3>عرض ملفات العروض المالية </h3>
                            <?php
                            include ('../database/config.php');

                            if (!isset($_SESSION['user_id'])) {
                                header("Location: auth-login.php");
                                exit();
                            }

                            $userRole = $_SESSION['user_role'];
                            $userId = $_SESSION['user_id'];

                            if ($userRole === 'super_admin') {
                                echo '<p class="text-subtitle text-muted">جميع ملفات العروض المالية الصادرة من نظام تثمين</p>';
                            } else {
                                echo '<p class="text-subtitle text-muted">ملفات العروض المالية الصادرة من قبلك</p>';
                            }


                            $conn->close();
                            ?>



                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start ">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسية</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">عرض الملفات</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-md-10 order-md-1 order-last">
                                    <h4 class="card-title"> </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1" style=" max-width: 90%; margin: 0 auto;">
                                <thead>
                                    <tr>
                                        <?php
                                        include ('../database/config.php');

                                        if (!isset($_SESSION['user_id'])) {
                                            header("Location: auth-login.php");
                                            exit();
                                        }

                                        $userRole = $_SESSION['user_role'];
                                        $userId = $_SESSION['user_id'];

                                        if ($userRole === 'super_admin') {
                                            echo '<th style="text-align: center;">اسم المسؤول</th>';
                                            echo '<th style="text-align: center;">اسم الملف</th>';
                                            echo '<th style="text-align: center;">تاريخ الإنشاء</th>';
                                            echo '<th style="text-align: center;">التنزيل</th>';
                                        } else {
                                            echo '<th style="text-align: center;">اسم الملف</th>';
                                            echo '<th style="text-align: center;">تاريخ الإنشاء</th>';
                                            echo '<th style="text-align: center;">التنزيل</th>';
                                        }

                                        $conn->close();
                                        ?>
                                    </tr>
                                </thead>

                                </thead>
                                <tbody style="text-align: center;">
                                    <?php
                                    include ('../database/config.php');



                                    if (!isset($_SESSION['user_id'])) {
                                        header("Location: auth-login.php");
                                        exit();
                                    }

                                    $userRole = $_SESSION['user_role'];
                                    $userId = $_SESSION['user_id'];

                                    if ($userRole === 'super_admin') {
                                        $sql = "SELECT fo.financialOffer_id, fo.file_name, fo.created_at, CONCAT(u.firstname, ' ', u.lastname) AS admin_name
                                FROM financialOffers fo
                                JOIN users u ON fo.user_id = u.id";
                                    } else {
                                        $sql = "SELECT fo.financialOffer_id, fo.file_name, fo.created_at, CONCAT(u.firstname, ' ', u.lastname) AS admin_name
                                FROM financialOffers fo
                                JOIN users u ON fo.user_id = u.id
                                WHERE fo.user_id = ?";
                                    }

                                    // إعداد الاستعلام
                                    $stmt = $conn->prepare($sql);

                                    if ($userRole !== 'super_admin') {
                                        $stmt->bind_param("i", $userId);
                                    }

                                    // تنفيذ الاستعلام
                                    $stmt->execute();
                                    $result = $stmt->get_result();


                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            if ($userRole === 'super_admin') {
                                                echo "<td>" . htmlspecialchars($row['admin_name']) . "</td>";
                                            }
                                            echo "<td>" . htmlspecialchars($row['file_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                            echo "<td class='download-button'>
                                    <a href='../database/fileDB2.php?financialOffer_id=" . urlencode($row['financialOffer_id']) . "' class='btn btn-primary'>
                                        تنزيل الملف <i class='bi bi-download'></i>
                                    </a>
                                  </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        $colspan = ($userRole === 'super_admin') ? 4 : 3; 
                                        echo "<tr><td colspan='$colspan'>لا توجد بيانات لعرضها.</td></tr>";
                                    }



                                    $stmt->close();
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
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
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
        <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>

        <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>


        <script>
            function downloadFile(id, button) {
                fetch('../database/fileDB2.php?financialOffer_id=' + id)
                    .then(response => {
                        if (response.ok) {
                            return response.blob();
                        }
                        throw new Error('Network response was not ok.');
                    })
                    .then(blob => {
                        let url = window.URL.createObjectURL(blob);
                        let a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = 'file_' + id + '.pdf'; 
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);

                        return fetch('../database/updateDownloadStatus.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ financialOffer_id: id })
                        });
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            }
        </script>



        <script>

            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>

        <script src="assets/js/main.js"></script>
</body>

</html>