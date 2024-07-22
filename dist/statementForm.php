<?php
include('../database/config.php');
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'delete':
            $id = $_POST['id'];
            $sql = "DELETE FROM statements WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            break;

        case 'edit':
            $id = $_POST['id'];
            $description = $_POST['description'];
            $sql = "UPDATE statements SET statement_description=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $description, $id);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            break;

        case 'add':
            $description = $_POST['description'];
            $sql = "INSERT INTO statements (statement_description) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $description);
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            break;
    }
    $stmt->close();
    $conn->close();
    exit();
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | إدارة بيان الشركة</title>
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
        .btn i {
            vertical-align: middle;

            position: relative;
            top: 4px;
        }

        .btn {
            line-height: 1.5;
            align-items: center;
        }

        .modal-title {
            color: white;
        }

        .table-responsive {
            max-width: 100%;
            margin: 0 auto 10px;

        }

        .table-responsive table {
            width: 80%;

        }

        .table-responsive .btn-container {
            display: flex;
            justify-content: center;

        }

        .table-responsive .action-column {
            width: 80px;

        }

        .table-responsive .btn {
            margin-right: 15px;

        }

        .section {
            padding-right: 10%;
        }

        .col-lg-10 {
            margin-left: auto;
            margin-right: auto;
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
                            <li class='sidebar-item <?= $current_page == ' company-information-form.php' ? 'active' : '' ?>
                            '>
                                <a href='company-information-form.php' class='sidebar-link'>
                                    <i class='bi bi-info-circle-fill'></i>
                                    <span>إدارة معلومات الشركة</span>
                                </a>
                            </li>
                            <li class='sidebar-item  active '>
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
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>نموذج إدارة بيان الشركة </h3>
                            <p class="text-subtitle text-muted">هذا البيان يتكون من عدة بنود تتعلق بسياسات وإجراءات
                                الشركة المتفق عليها مع العملاء. يُرجى ملاحظة أن هذه البنود قد تم الاتفاق عليها بعناية،
                                وأي تعديلات عليها يجب أن تتم بحذر وبعد التشاور مع جميع الأطراف المعنية لضمان الحفاظ على
                                التوازن والمصلحة المشتركة.

                            </p>
                        </div>

                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start ">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسة</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">إدارة بيان الشركة</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>

                <!-- HTML Structure -->
                <section class="section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div id="message" class="mt-3"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">رقم البند</th>
                                                <th style="text-align: center;">وصف البند</th>
                                                <th style="text-align: center;">الإجراء</th>
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
                                                    echo "<button class='btn btn-warning edit-btn' onclick='editStatement(this, " . $row["id"] . ")'><i class='bi bi-pencil-square'></i></button> ";
                                                    echo "<button class='btn btn-danger' onclick='showDeleteModal(" . $row["id"] . ")'><i class='bi bi-trash'></i></button>";
                                                    echo "<button class='btn btn-success save-btn' onclick='saveStatement(this, " . $row["id"] . ")' style='display: none;'><i class='bi bi-check'></i></button>";
                                                    echo "<button class='btn btn-secondary cancel-btn' onclick='cancelEdit(this)' style='display: none;'><i class='bi bi-x'></i></button>";
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
                                <br>
                                <button class="btn btn-sm btn-primary rounded-pill next mx-2" onclick="addNewRow()">
                                    <i class="bi bi-plus-circle" style=" margin-left: 5px; "></i> إضافة بند جديد
                                </button>
                            </div>
                        </div>
                    </div>
                </section>


            </div>







            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background: #DF0500">
                            <h5 class="modal-title" id="deleteModalLabel" style="width:50%; font-family: 'Cairo', sans-serif;"> تأكيد الحذف </h5>

                        </div>
                        <div class="modal-body" style="font-family: 'Cairo', sans-serif;">
                            هل أنت متأكد أنك تريد حذف هذا البند من البيان
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteButton">حذف</button>
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
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>

    </div>





    </div>


    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- JavaScript Code -->
    <script>
        let deleteId = null;

        function showAlert(message, type) {
            const messageContainer = document.getElementById('message');
            const tableWidth = document.querySelector('.table-responsive').clientWidth;

            messageContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible show fade" style="width: 860px;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        }

        function showDeleteModal(id) {
            deleteId = id;
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {});
            deleteModal.show();
        }

        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            deleteStatement(deleteId);
        });

        function deleteStatement(id) {
            let formData = new FormData();
            formData.append('action', 'delete');
            formData.append('id', id);

            fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        showAlert('حدث خطأ أثناء الحذف', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('حدث خطأ غير متوقع', 'danger');
                });
        }

        function editStatement(button, id) {
            let row = button.closest('tr');
            row.querySelector('.description').style.display = 'none';
            row.querySelector('.edit-input').style.display = 'inline-block';
            button.style.display = 'none';
            row.querySelector('.save-btn').style.display = 'inline-block';
            row.querySelector('.cancel-btn').style.display = 'inline-block';
        }

        function cancelEdit(button) {
            let row = button.closest('tr');
            row.querySelector('.description').style.display = 'inline-block';
            row.querySelector('.edit-input').style.display = 'none';
            row.querySelector('.edit-btn').style.display = 'inline-block';
            row.querySelector('.save-btn').style.display = 'none';
            row.querySelector('.cancel-btn').style.display = 'none';
        }

        function saveStatement(button, id) {
            let row = button.closest('tr');
            let newDescription = row.querySelector('.edit-input').value;

            if (!newDescription.trim()) {
                showAlert('الوصف لا يمكن أن يكون فارغًا', 'warning');
                return;
            }

            let formData = new FormData();
            formData.append('action', 'edit');
            formData.append('id', id);
            formData.append('description', newDescription);

            fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('تم التعديل بنجاح', 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showAlert('حدث خطأ أثناء التعديل', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('حدث خطأ غير متوقع', 'danger');
                });
        }

        function addNewRow() {
            if (document.getElementById('noDataRow')) {
                document.getElementById('noDataRow').remove();
            }
            let tbody = document.getElementById('statementTableBody');
            let newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td>جديد</td>
            <td><input type='text' class='form-control new-description'></td>
            <td style='text-align: center;'>
                <button class='btn btn-success' onclick='saveNewStatement(this)'><i class='bi bi-check'></i></button>
                <button class='btn btn-secondary' onclick='cancelNewRow(this)'><i class='bi bi-x'></i></button>
            </td>
        `;
            tbody.appendChild(newRow);
        }

        function cancelNewRow(button) {
            let row = button.closest('tr');
            row.remove();
            if (!document.getElementById('statementTableBody').childElementCount) {
                let tbody = document.getElementById('statementTableBody');
                let noDataRow = document.createElement('tr');
                noDataRow.id = 'noDataRow';
                noDataRow.innerHTML = "<td colspan='3' style='text-align: center;'>لا توجد بيانات</td>";
                tbody.appendChild(noDataRow);
            }
        }

        function saveNewStatement(button) {
            let row = button.closest('tr');
            let newDescription = row.querySelector('.new-description').value;

            if (!newDescription.trim()) {
                showAlert('الوصف لا يمكن أن يكون فارغًا', 'warning');
                return;
            }

            let formData = new FormData();
            formData.append('action', 'add');
            formData.append('description', newDescription);

            fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('تمت الإضافة بنجاح', 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showAlert('حدث خطأ أثناء الإضافة', 'warning');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('حدث خطأ غير متوقع', 'danger');
                });
        }
    </script>

</body>

</html>