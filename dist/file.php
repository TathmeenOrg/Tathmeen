<?php
include ('../database/config.php');

session_start();
if (isset($_POST['action']) && $_POST['action'] == 'viewedFile') {
    $_SESSION['hasViewedFile'] = true;
    exit;
}


$financialOffer_id = isset($_GET['financialOffer_id']) ? intval($_GET['financialOffer_id']) : 0;
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT association_name, client_address, created_at FROM financialoffers WHERE financialOffer_id = ?");
$stmt->bind_param("i", $financialOffer_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $association_name = $row['association_name'];
    $client_address = $row['client_address'];
    $created_at = $row['created_at'];
} else {
    $association_name = $client_address = $created_at = '';
}
$stmt->close();




$services_stmt = $conn->prepare("SELECT service, service_price, quantity, total_service_price FROM services WHERE user_id = ? AND financialOffer_id = ?");
$services_stmt->bind_param("ii", $user_id, $financialOffer_id);
$services_stmt->execute();
$services_result = $services_stmt->get_result();
$services = [];
if ($services_result->num_rows > 0) {
    while ($service_row = $services_result->fetch_assoc()) {
        $services[] = $service_row;
    }
}
$services_stmt->close();


$statements_stmt = $conn->prepare("SELECT * FROM statements");
$statements_stmt->execute();
$statements_result = $statements_stmt->get_result();
$statements = [];
if ($statements_result->num_rows > 0) {
    while ($statement_row = $statements_result->fetch_assoc()) {
        $statements[] = $statement_row;
    }
}
$statements_stmt->close();

$conn->close();
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | ملف العرض المالي </title>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</head>

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

    .card-body {
        font-family: 'Cairo', serif;
        direction: rtl;


    }

    .section {
        margin-bottom: 50px;
    }

    .card-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-primary {
        margin-top: 10px;
    }

    .no-border-table th,
    .no-border-table td {
        border: none;
    }

    .custom-bg {
        background-color: #C0ECEE;
    }

    .card {
        width: 70%;
        max-width: 100%;
        margin: 0 auto;
    }

    .header-images {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header-images img {
        height: auto;
        max-width: 30%;
    }

    .img1 {
        width: 100px;
    }

    .img2 {
        width: 200px;
    }

    .img3 {
        width: 150px;
    }

    h6 {
        text-align: center;
    }
</style>

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

                        <p class="text-subtitle text-muted"> </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="financialOffersForm.php">نموذج العرض المالي
                                    </a></li>
                                <li class="breadcrumb-item active" aria-current="page">ملف العرض المالي </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- //------------------------------------------------------- -->

            <section id="congratulationsSection" class="section">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>مبروك!</h3>
                        <p>لقد أكملت العرض المالي بنجاح.</p>
                        <button id="showFileButton" class="btn btn-primary">عرض الملف</button>
                        <button id="exitButton" class="btn btn-primary">إنهاء </button>
                    </div>
                </div>
            </section>

            <!-- //------------------------------------------------------- -->

            <section id="financialOfferSection" class="section" style="display: none;">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body " id="financialOfferCard">

                                <!-- إضافة الصور -->
                                <div class="header-images">
                                    <img src="assets/images/logo/awonLogo.png" alt="شعار 1" class="img1">
                                    <img src="assets/images/logo/awon.png" alt="شعار 2" class="img2">
                                    <img src="assets/images/logo/logo1.png" alt="شعار 3" class="img3">
                                </div>

                                <!-- Table 1: العرض المالي -->
                                <div class="custom-bg p-2 mb-3">
                                    <h6>العرض المالي</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">السادة</th>
                                                <td><?php echo $association_name; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">التاريخ</th>
                                                <td><?php echo $created_at; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">عنوان العميل</th>
                                                <td><?php echo $client_address; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Table 2: الخدمات -->
                                <div class="custom-bg p-2 mb-3 mt-4">
                                    <h6>الخدمات</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>رقم البند</th>
                                                <th>الخدمة</th>
                                                <th>سعر الخدمة</th>
                                                <th>الكمية</th>
                                                <th>السعر الاجمالي</th>
                                            </tr>
                                        </thead>
                                        <tbody id="services_table">
                                            <?php foreach ($services as $index => $service): ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td><?php echo $service['service']; ?></td>
                                                    <td><?php echo $service['service_price']; ?></td>
                                                    <td><?php echo $service['quantity']; ?></td>
                                                    <td><?php echo $service['total_service_price']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Table 3: البيان -->
                                <div class="custom-bg p-2 mb-3 mt-4">
                                    <h6>البيان</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0 no-border-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="statements_table">
                                            <?php foreach ($statements as $statement): ?>
                                                <tr>
                                                    <td><?php echo $statement['id']; ?></td>
                                                    <td><?php echo $statement['statement_description']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Table 4: سياسة الدفع -->
                                <div class="custom-bg p-2 mb-3 mt-4">
                                    <h6>سياسة الدفع </h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>رقم الدفعة</th>
                                                <th>نسبة الدفعة</th>
                                            </tr>
                                        </thead>
                                        <tbody id="payment_policy_table">
                                            <?php
                                            include ('../database/config.php');

                                            if (!isset($_SESSION['offer_id'])) {
                                                echo "<tr><td colspan='2'>لا يوجد عرض محدد.</td></tr>";
                                                exit();
                                            }

                                            $financial_offer_id = $_SESSION['offer_id'];


                                            $query = "SELECT payment_number, payment_percentage FROM payments WHERE financial_offer_id = ?";
                                            $stmt = $conn->prepare($query);
                                            $stmt->bind_param("i", $financial_offer_id);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['payment_number']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['payment_percentage']) . "%</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='2'>لا توجد بيانات لعرضها.</td></tr>";
                                            }

                                            $stmt->close();
                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>


                                <div class="text-center mt-4">
                                    <p>يتم تحويل المبلغ إلى حساب جمعية عون التقنية</p>
                                    <img src="assets/images/samples/qr-code.png" alt="باركود حساب الشركة"
                                        class="img-fluid" style="max-width: 15%;">
                                </div>


                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">

                            <?php
                            include ('../database/config.php');

                            $stmt = $conn->prepare("SELECT financialOffer_id FROM financialOffers WHERE financialOffer_id = ?");
                            $stmt->bind_param('i', $financialOffer_id);
                            $stmt->execute();
                            $stmt->store_result();

                            if ($stmt->num_rows > 0) {
                                echo "<a href='../database/fileDB2.php?financialOffer_id=" . urlencode($financialOffer_id) . "' class='btn btn-primary'>تنزيل الملف <i class='bi bi-download'></i></a>";
                            }



                            $stmt->close();
                            $conn->close();
                            ?>
                        </div>
                    </div>
            </section>

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
        document.addEventListener('DOMContentLoaded', function () {
            var showFileButton = document.getElementById('showFileButton');
            var congratulationsSection = document.getElementById('congratulationsSection');
            var financialOfferSection = document.getElementById('financialOfferSection');


            function generateAndSendPDF(onSuccess) {
                const element = document.getElementById('financialOfferCard');
                const created_at = <?php echo json_encode($created_at); ?>;
                const financialOfferId = <?php echo json_encode($financialOffer_id); ?>;
                const userId = <?php echo json_encode($user_id); ?>;

                const fileName = `${created_at}-${financialOfferId}.pdf`;

                html2pdf()
                    .set({
                        margin: 10,
                        filename: fileName,
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { dpi: 192, letterRendering: true, useCORS: true },
                        jsPDF: { unit: 'pt', format: 'letter', orientation: 'portrait' }
                    })
                    .from(element)
                    .toPdf()
                    .get('pdf')
                    .then(function (pdf) {
                        const pdfData = pdf.output('blob');
                        const formData = new FormData();
                        formData.append('pdf', pdfData, fileName);
                        formData.append('financialOffer_id', financialOfferId);
                        formData.append('user_id', userId);

                        return fetch('../database/fileDB.php', {
                            method: 'POST',
                            body: formData
                        });
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log('File successfully saved:', data);
                        if (onSuccess) onSuccess();
                    })
                    .catch(error => {
                        console.error('Error saving file:', error);
                    });
            }


            document.getElementById('exitButton').addEventListener('click', function () {
                generateAndSendPDF(function () {
                    window.location.href = 'index.php';
                });
            });


            showFileButton.addEventListener('click', function () {

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'file.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('action=viewedFile');


                xhr.onload = function () {
                    if (xhr.status === 200) {

                        generateAndSendPDF(function () {
                            congratulationsSection.style.display = 'none';
                            financialOfferSection.style.display = 'block';
                        });
                    } else {
                        console.error('فشل إرسال الطلب لتعبئة البيانات:', xhr.statusText);
                    }
                };
            });


            window.addEventListener('beforeunload', function (event) {
                generateAndSendPDF();
                event.returnValue = '';
            });
        });
    </script>









</body>

</html>