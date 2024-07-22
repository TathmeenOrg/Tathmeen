<?php
include('../database/config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | نموذج إنشاء عرض مالي </title>
    <link rel="icon" href="assets/images/logo/tathmeen_logo.png">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .alert {
            margin: 10px 0;
            height: 3rem;
            margin-left: 3rem;
            /* text-align: center; */
            margin-right: 3rem;
        }

        .alert-light-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .color-danger {
            color: #721c24;
        }

        .modal {
            text-align: center;
        }

        .modal-dialog {
            display: inline-block;
            text-align: left;
        }

        .wizard,
        .wizard .nav-tabs,
        .wizard .nav-tabs .nav-item {
            position: relative;

        }

        .wizard .nav-tabs:after {
            content: "";
            width: 80%;
            border-bottom: solid 2px #ccc;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            top: 38%;
            z-index: -1;
        }

        .wizard .nav-tabs .nav-item .nav-link1 {
            width: 70px;
            height: 70px;
            margin-bottom: 6%;
            background: white;
            border: 2px solid #ccc;
            color: #ccc;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
        }

        .wizard .nav-tabs .nav-item .nav-link1:hover {
            color: #333;
            border: 2px solid #333;
        }

        .wizard .nav-tabs .nav-item .nav-link1.active {
            background: linear-gradient(to right, #435ebe, #8f94fb);
            border: none;
            color: #fff;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            display: inline-block;
        }


        .wizard .nav-tabs .nav-item .nav-link1.active:after {
            content: " ";
            position: absolute;
            left: 50%;
            transform: translate(-50%);
            opacity: 1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #5a8dee;
        }

        label::after {
            content: " *";
            color: #af3030;
            font-weight: bold;
            margin-left: 5px;
        }

        #AttrRequired::after {
            content: " *";
            color: #af3030;
            font-weight: bold;
            margin-left: 5px;
        }

        .btn i {
            vertical-align: middle;

            position: relative;
            top: 4px;
        }

        .btn {
            line-height: 1.5;
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

            <div class="page-heading" style="font-family: 'Cairo', sans-serif;">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>نموذج العرض المالي</h3>
                            <p class="text-subtitle text-muted" style="font-family: 'Cairo', sans-serif;">إنشاء عرض مالي
                                جديد</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start ">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسة</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">إنشاء عرض مالي جديد</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="container" style="font-family: 'Cairo', sans-serif;">
                        <div class="wizard my-5">
                            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top" title="Step 1">
                                    <a class="nav-link1 active rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step1" id="step1-tab" data-bs-toggle="tab" role="tab" aria-controls="step1" aria-selected="true">
                                        1
                                    </a>
                                </li>
                                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top" title="Step 2">
                                    <a class="nav-link1 rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step2" id="step2-tab" data-bs-toggle="tab" role="tab" aria-controls="step2" aria-selected="false">
                                        2
                                    </a>
                                </li>
                                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top" title="Step 3">
                                    <a class="nav-link1 rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step3" id="step3-tab" data-bs-toggle="tab" role="tab" aria-controls="step3" aria-selected="false">
                                        3
                                    </a>
                                </li>
                                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip" data-bs-placement="top" title="Step 4">
                                    <a class="nav-link1 rounded-circle mx-auto d-flex align-items-center justify-content-center" href="#step4" id="step4-tab" data-bs-toggle="tab" role="tab" aria-controls="step4" aria-selected="false">
                                        4
                                    </a>
                                </li>
                                <!-- <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Step 5">
                                    <a class="nav-link1 rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        href="#step5" id="step5-tab" data-bs-toggle="tab" role="tab"
                                        aria-controls="step5" aria-selected="false">
                                        5
                                    </a>
                                </li> -->
                            </ul>
                        </div>

                        <form class="form form-horizontal" id="financialoffersForm" method="POST" action="../database/financialoffersAndServicsDB.php">
                            <div class="tab-content" id="myTabContent">


                                <div class="tab-pane fade show active" role="tabpanel" id="step1" aria-labelledby="step1-tab" style="margin-top: 25px;">
                                    <h3 class="text-center">القسم الأول</h3>
                                    <section id="basic-horizontal-layouts">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">المعلومات الأساسية</h4>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>اسم الشركة</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <input type="text" id="first-name" class="form-control" name="association_name" placeholder="أدخل اسم الشركة" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>تاريخ إنشاء العرض</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <input type="date" id="creation-date" class="form-control" name="created_at" readonly>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>عنوان العميل</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <input type="text" id="contact-info" class="form-control" name="client_address" placeholder="أدخل عنوان العميل" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-lg btn-primary rounded-pill back mx-2" style="pointer-events: none; opacity: 0.6;"><i class="fas fa-angle-right"></i> السابق</button>
                                                    <button type="button" class="btn btn-lg btn-primary rounded-pill next mx-2">التالي <i class="fas fa-angle-left"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="step2" aria-labelledby="step2-tab" style="margin-top: 25px;">
                                    <h3 class="text-center">القسم الثاني</h3>
                                    <section class="section">
                                        <div class="row justify-content-center" id="table-hover-row">
                                            <div class="col-md-8 col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">الخدمات</h4>
                                                        <p>إضافة خدمة واحدة على الأقل</p>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover mb-0" id="serviceTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th id="AttrRequired">الخدمة</th>
                                                                        <th id="AttrRequired">سعر الخدمة</th>
                                                                        <th id="AttrRequired">الكمية</th>
                                                                        <th>السعر الإجمالي للخدمة</th>
                                                                        <th>الإجراء</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><input type="text" name="service[]" class="form-control service" placeholder="أدخل الخدمة" required></td>
                                                                        <td><input type="number" name="service_price[]" class="form-control rate" placeholder="أدخل سعر الخدمة" min="0" pattern="[0-9]*" required></td>
                                                                        <td><input type="number" name="quantity[]" class="form-control quantity" placeholder="أدخل الكمية" min="1" pattern="[0-9]*" required></td>
                                                                        <td><input type="number" name="total_service_price[]" class="form-control total" placeholder="السعر الإجمالي" required readonly>
                                                                        </td>

                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="3" style="font-weight: bold;">السعر
                                                                            الإجمالي</td>
                                                                        <td><input type="number" class="form-control" id="overallTotal" style="background-color: transparent; border: transparent; font-weight: bold;" readonly></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>

                                                        <div class="d-flex  mt-3" style="padding-bottom: 20px; padding-right: 10px;">
                                                            <button type="button" class="btn btn-secondary" id="addRow">
                                                                <i class="bi bi-plus-circle"></i> إضافة خدمة
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-lg btn-primary rounded-pill back mx-2"><i class="fas fa-angle-right"></i> السابق</button>
                                                    <button type="button" class="btn btn-lg btn-primary rounded-pill next mx-2">التالي <i class="fas fa-angle-left"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>






                                <!-- //------------------------------------  Mannnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnar :  -->

                                <div class="tab-pane fade" role="tabpanel" id="step3" aria-labelledby="step3-tab" style="margin-top: 25px;">
                                    <h3 class="text-center">القسم الثالث</h3>

                                    <section id="basic-horizontal-layouts">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8 col-12">
                                                <div class="card" style="padding-bottom: 20px;">
                                                    <div class="card-header">
                                                        <h4 class="card-title">بنود البيان </h4>
                                                    </div>



                                                    <table class="table table-striped mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;">رقم البند</th>
                                                                <th style="text-align: center;"> البند</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="statementTableBody">
                                                            <?php
                                                            include('../database/config.php');
                                                            $sql = "SELECT id, statement_description FROM statements ORDER BY id ASC";
                                                            $result = $conn->query($sql);

                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<tr>";
                                                                    echo "<td class='statement-id' style='text-align: center;'>" . $row["id"] . "</td>";
                                                                    echo "<td style='text-align: center;'><span class='description'>" . $row["statement_description"] . "</span><input type='text' class='form-control edit-input' value='" . $row["statement_description"] . "' style='display: none;'></td>";
                                                                    echo "<td style='text-align: center;'>";

                                                                    echo "</td>";
                                                                    echo "</tr>";
                                                                }
                                                            } else {
                                                                echo "<tr><td colspan='3' style='text-align: center;'>لا توجد بيانات</td></tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>


                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-lg btn-primary rounded-pill back mx-2"><i class="fas fa-angle-right"></i> السابق</button>
                                                    <button type="button" class="btn btn-lg btn-primary rounded-pill next mx-2">التالي
                                                        <i class="fas fa-angle-left"></i></button>
                                                </div>

                                            </div>
                                        </div>

                                    </section>
                                </div>


                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                                <div class="tab-pane fade" role="tabpanel" id="step4" aria-labelledby="step4-tab" style="margin-top: 25px;">
                                    <h3 class="text-center">القسم الرابع</h3>
                                    <section id="basic-horizontal-layouts">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8 col-12">
                                                <div class="card" style="padding-bottom: 20px;">
                                                    <div class="card-header">
                                                        <h4 class="card-title">سياسة الدفع</h4>
                                                    </div>
                                                    <div id="alert-container"></div>

                                                    <!-- Question Section -->
                                                    <div id="question-section" class="text-center">
                                                        <h5>هل تريد تقسيم مبلغ العرض المالي على دفعات؟</h5>
                                                        <button type="button" class="btn btn-success mx-2" onclick="showInstallmentForm()">نعم</button>
                                                        <button type="button" class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#confirmationModal">لا</button>
                                                    </div>

                                                    <!-- Installment Form Section -->
                                                    <div id="installment-form-section" style="display: none;">
                                                        <div id="alerts-section">
                                                            <div id="totalPercentageMessage"></div>
                                                            <div id="checkInvalidInputMessage"></div>
                                                            <div id="checkIntegerMessage"></div>
                                                        </div>
                                                        <table class="table table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align: center;">رقم الدفعة</th>
                                                                    <th style="text-align: center;">نسبة الدفعة (٪)</th>
                                                                    <th style="text-align: center;">الإجراءات</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="installmentTableBody">
                                                                <!-- Rows will be added dynamically -->
                                                            </tbody>
                                                        </table>
                                                        <button type="button" class="btn btn-primary mt-2" onclick="addInstallmentRow()">إضافة دفعة</button>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-lg btn-primary rounded-pill back mx-2"><i class="fas fa-angle-right"></i> السابق</a>
                                                    <button id="saveButton" type="submit" name="submitBu" class="btn btn-lg btn-primary rounded-pill mx-2" disabled>حفظ وإنهاء<i class="fas fa-angle-left"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>

                        </form>
                    </div>
                </section>


            </div>


            <!-- Modal for Confirmation -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <h5 class="modal-title" id="confirmationModalLabel">هل أنت متأكد ؟</h5>
                        </div>
                        <div class="modal-body">
                            سوف تدفع المبلغ الإجمالي للعرض المالي دفعة واحدة كاملة.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="button" class="btn btn-danger" id="confirmSinglePayment">لا ارغب بتقسيم المبلغ</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Logout Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="width: 150%;">
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
                        <p>2024 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <script>
        // Function to check if all required fields are filled
        function checkRequiredFields() {
            let currentTabPane = document.querySelector('.tab-pane.active');
            let inputs = currentTabPane.querySelectorAll('input[required]');
            let allFilled = true;

            inputs.forEach(input => {
                if (!input.value.trim()) { // Check if input value is empty
                    allFilled = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            return allFilled;
        }

        // Function to enable/disable pointer events based on form completion
        function togglePointerEvents(enabled) {
            let navLinks = document.querySelectorAll('.nav-tabs .nav-link1');
            navLinks.forEach(link => {
                link.style.pointerEvents = enabled ? 'auto' : 'none';
            });
        }

        // Function to move to the next step if all required fields are filled
        function moveToNextStep() {
            if (checkRequiredFields()) {
                let activeTab = document.querySelector('.nav-tabs .nav-link1.active');
                let nextTab = activeTab.parentElement.nextElementSibling?.querySelector('.nav-link1');
                if (nextTab) {
                    nextTab.click(); // Move to the next tab
                }
            }
        }

        // Function to move to the previous step
        function moveToPreviousStep() {
            let activeTab = document.querySelector('.nav-tabs .nav-link1.active');
            let previousTab = activeTab.parentElement.previousElementSibling?.querySelector('.nav-link1');
            if (previousTab) {
                previousTab.click(); // Move to the previous tab
            }
        }

        // Function to update active tab styles based on current active tab
        function updateActiveTabStyleAfterBack() {
            let activeTab = document.querySelector('.nav-tabs .nav-link1.active');

            // Remove active class from all tabs
            document.querySelectorAll('.nav-tabs .nav-link1').forEach(tab => {
                tab.classList.remove('active');
            });

            // Add active class to current active tab
            activeTab.classList.add('active');
        }

        // Function to save current step data if needed
        function saveCurrentStepData(stepNumber) {
            console.log(`Saving data for step ${stepNumber}`);
        }

        // Function to save the entire form data
        function saveFormData() {
            console.log('Saving entire form data');
            document.getElementById('financialoffersForm').submit();
        }

        // Function to handle next step
        function handleNextStep(stepNumber) {
            saveCurrentStepData(stepNumber);
            moveToNextStep();
        }

        // Event listener for next button click
        document.querySelectorAll('.next').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent default form submission behavior
                handleNextStep(); // Adjust according to your logic
            });
        });

        // Event listener for back button click
        document.querySelectorAll('.back').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent default form submission behavior
                moveToPreviousStep();

                // Update active tab styles after moving to the previous step
                setTimeout(() => {
                    updateActiveTabStyleAfterBack();
                }, 300); // Adjust delay if needed to ensure proper tab switching
            });
        });

        // Event listener for tab clicks to handle pointer events
        document.querySelectorAll('.nav-tabs .nav-link1').forEach(tab => {
            tab.addEventListener('click', (event) => {
                event.preventDefault();
                let clickedTab = event.target;
                let activeTab = document.querySelector('.nav-tabs .nav-link1.active');

                if (!clickedTab.classList.contains('active')) {
                    if (checkRequiredFields()) {
                        togglePointerEvents(true); // Enable pointer events

                        // Disable pointer events for all subsequent tabs
                        let clickedTabIndex = Array.from(clickedTab.parentElement.children).indexOf(clickedTab);
                        let navLinks = document.querySelectorAll('.nav-tabs .nav-link1');
                        navLinks.forEach((link, index) => {
                            if (index > clickedTabIndex) {
                                link.style.pointerEvents = 'auto';
                            }
                        });

                        activeTab.classList.remove('active');
                        clickedTab.classList.add('active');

                        // Find the corresponding content tab and activate it
                        let targetId = clickedTab.getAttribute('href');
                        let targetPane = document.querySelector(targetId);

                        if (targetPane) {
                            let activePane = document.querySelector('.tab-pane.active');
                            if (activePane) {
                                activePane.classList.remove('active', 'show');
                            }
                            targetPane.classList.add('active', 'show');
                        }
                    }
                }
            });
        });

        // Initialize: Disable pointer events for tabs initially until form is completed
        togglePointerEvents(false);

        // Automatically activate the first tab on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('step1-tab').click();
        });

        // Service Table Calculations
        document.addEventListener('DOMContentLoaded', function() {
            function calculateRowTotal(row) {
                const rate = parseFloat(row.querySelector('.rate').value) || 0;
                const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                const total = row.querySelector('.total');
                total.value = rate * quantity;
                calculateOverallTotal();
            }

            function calculateOverallTotal() {
                const rows = document.querySelectorAll('#serviceTable tbody tr');
                let overallTotal = 0;
                rows.forEach(row => {
                    const total = parseFloat(row.querySelector('.total').value) || 0;
                    overallTotal += total;
                });
                document.getElementById('overallTotal').value = overallTotal;
            }

            document.getElementById('addRow').addEventListener('click', function() {
                const table = document.getElementById('serviceTable').getElementsByTagName('tbody')[0];
                const newRow = table.insertRow();

                // Insert cells in the new row
                const serviceCell = newRow.insertCell(0);
                const rateCell = newRow.insertCell(1);
                const quantityCell = newRow.insertCell(2);
                const totalCell = newRow.insertCell(3);
                const actionCell = newRow.insertCell(4);

                // Add content to the new cells
                serviceCell.innerHTML = '<input type="text" name="service[]" class="form-control service" placeholder="أدخل الخدمة" required>';
                rateCell.innerHTML = '<input type="number" name="service_price[]" class="form-control rate" placeholder="أدخل سعر الخدمة" min="0" pattern="[0-9]*" required>';
                quantityCell.innerHTML = '<input type="number" name="quantity[]" class="form-control quantity" placeholder="أدخل الكمية" min="0" pattern="[0-9]*" required>';
                totalCell.innerHTML = '<input type="number" name="total_service_price[]" class="form-control total" placeholder="السعر الإجمالي" readonly>';
                actionCell.innerHTML = '<button type="button" class="btn badge bg-danger badge-pill badge-round ml-1 btn-sm removeRow">X</button>';

                newRow.querySelectorAll('.rate, .quantity').forEach(input => {
                    input.addEventListener('input', () => calculateRowTotal(newRow));
                });

                newRow.querySelector('.removeRow').addEventListener('click', function() {
                    newRow.remove();
                    calculateOverallTotal();
                });
            });

            document.querySelectorAll('#serviceTable .rate, #serviceTable .quantity').forEach(input => {
                input.addEventListener('input', function() {
                    const row = input.closest('tr');
                    calculateRowTotal(row);
                });
            });

            document.querySelectorAll('#serviceTable .removeRow').forEach(button => {
                button.addEventListener('click', function() {
                    const row = button.closest('tr');
                    row.remove();
                    calculateOverallTotal();
                });
            });

            calculateOverallTotal();
        });

        // Automatically set the current date in the date input field
        document.addEventListener('DOMContentLoaded', function() {
            const creationDateInput = document.getElementById('creation-date');
            const today = new Date().toISOString().split('T')[0];
            creationDateInput.value = today;
        });
    </script>






    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/mazer.js"></script>

    <script>
        let installmentCount = 0;

        function showInstallmentForm() {
            document.getElementById('question-section').style.display = 'none';
            document.getElementById('installment-form-section').style.display = 'block';
            document.getElementById('saveButton').disabled = true;
        }

        function hideInstallmentForm() {
            document.getElementById('question-section').style.display = 'block';
            document.getElementById('installment-form-section').style.display = 'none';
        }

        function addInstallmentRow() {
            const tbody = document.getElementById('installmentTableBody');
            const row = document.createElement('tr');
            const installmentNumber = installmentCount + 1;

            row.innerHTML = `
            <td style="text-align: center;">${installmentNumber}</td>
            <td style="text-align: center;"><input type="number" class="form-control installment-percentage" name="installment_percentage[]" min="0" max="100" step="1" required></td>
            <td style="text-align: center;"><button type="button" class="btn btn-danger" onclick="removeInstallmentRow(this)">حذف</button></td>
        `;
            tbody.appendChild(row);
            installmentCount++;

            // Attach event listener to the new input for validation
            row.querySelector('.installment-percentage').addEventListener('input', validateInstallmentPercentages);

            validateInstallmentPercentages(); // Run validation
        }

        function removeInstallmentRow(button) {
            const row = button.closest('tr');
            row.remove();
            installmentCount--;

            updateInstallmentNumbers();
            validateInstallmentPercentages(); // Run validation
        }

        function updateInstallmentNumbers() {
            const rows = document.querySelectorAll('#installmentTableBody tr');
            rows.forEach((row, index) => {
                row.querySelector('td').innerText = index + 1; // Update installment number
            });
        }

        function validateInstallmentPercentages() {
            const percentages = document.querySelectorAll('.installment-percentage');
            let totalPercentage = 0;
            let allInputsValid = true;
            let allIntegers = true;

            percentages.forEach(input => {
                const value = parseFloat(input.value);
                if (isNaN(value) || value < 1 || value > 100) {
                    allInputsValid = false;
                }
                totalPercentage += value;

                // Check if the input is an integer
                if (!Number.isInteger(value)) {
                    allIntegers = false;
                }
            });

            const totalPercentageMessage = document.getElementById('totalPercentageMessage');
            const checkIntegerMessage = document.getElementById('checkIntegerMessage');
            const checkInvalidInputMessage = document.getElementById('checkInvalidInputMessage');

            totalPercentageMessage.innerHTML = '';
            checkIntegerMessage.innerHTML = '';
            checkInvalidInputMessage.innerHTML = '';

            if (totalPercentage !== 100) {
                totalPercentageMessage.innerHTML = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> يجب أن يكون مجموع النسب 100٪</div>';
            }

            if (!allInputsValid) {
                checkInvalidInputMessage.innerHTML = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> يجب أن تكون جميع النسب بين 1 و 100</div>';
            }

            if (!allIntegers) {
                checkIntegerMessage.innerHTML = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> يجب أن تكون جميع القيم أعداد صحيحة</div>';
            }

            document.getElementById('saveButton').disabled = !(totalPercentage === 100 && allInputsValid && allIntegers);
        }
        document.getElementById('confirmSinglePayment').addEventListener('click', function() {
            document.getElementById('question-section').remove();
            document.getElementById('installment-form-section').remove();
            document.getElementById('saveButton').disabled = false;
            var alertContainer = document.getElementById('alert-container');
            var alertMessage = document.createElement('div');
            alertMessage.classList.add('alert', 'alert-success');
            alertMessage.innerText = 'تمت إضافة دفعة واحدة بنسبة 100٪.';
            alertContainer.appendChild(alertMessage);
            var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.hide();
        });
    </script>

</body>

</html>