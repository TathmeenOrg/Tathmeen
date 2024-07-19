<?php
include('../database/config.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM statements WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
           
            $updateSql = "SET @num := 0; UPDATE statements SET id = @num := (@num+1); ALTER TABLE statements AUTO_INCREMENT = 1;";
            $con->multi_query($updateSql);
            $con->next_result(); 
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        $stmt->close();
        exit;
    } elseif ($action === 'edit') {
        $id = $_POST['id'];
        $description = $_POST['description'];

  
        $sqlCheck = "SELECT statement_description FROM statements WHERE id = ?";
        $stmtCheck = $con->prepare($sqlCheck);
        $stmtCheck->bind_param("i", $id);
        $stmtCheck->execute();
        $stmtCheck->bind_result($current_description);
        $stmtCheck->fetch();
        $stmtCheck->close();

        
        if ($description === $current_description) {
            echo json_encode(['success' => true]);
            exit;
        }

        $sql = "UPDATE statements SET statement_description = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $description, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        $stmt->close();
        exit;
    } elseif ($action === 'add') {
        $description = $_POST['description'];
        $sql = "INSERT INTO statements (statement_description) VALUES (?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $description);

        if ($stmt->execute()) {
          
            $updateSql = "SET @num := 0; UPDATE statements SET id = @num := (@num+1); ALTER TABLE statements AUTO_INCREMENT = 1;";
            $con->multi_query($updateSql);
            $con->next_result(); 
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        $stmt->close();
        exit;
    }
}


$sql = "SELECT id, statement_description FROM statements";
$result = $con->query($sql);


$statements = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $statements[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة بيان الشركة </title>


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
                            <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Components</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="component-alert.html">Alert</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-badge.html">Badge</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-breadcrumb.html">Breadcrumb</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-button.html">Button</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-card.html">Card</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-carousel.html">Carousel</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-dropdown.html">Dropdown</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-list-group.html">List Group</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-modal.html">Modal</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-navs.html">Navs</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-pagination.html">Pagination</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-progress.html">Progress</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-spinner.html">Spinner</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-tooltip.html">Tooltip</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Extra Components</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="extra-component-avatar.html">Avatar</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="extra-component-sweetalert.html">Sweet Alert</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="extra-component-toastify.html">Toastify</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="extra-component-rating.html">Rating</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="extra-component-divider.html">Divider</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Layouts</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="layout-default.html">Default Layout</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-1-column.html">1 Column</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-vertical-navbar.html">Vertical with Navbar</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="layout-horizontal.html">Horizontal Menu</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Forms &amp; Tables</li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-hexagon-fill"></i>
                                <span>Form Elements</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="form-element-input.html">Input</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-input-group.html">Input Group</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-select.html">Select</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-radio.html">Radio</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-checkbox.html">Checkbox</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-element-textarea.html">Textarea</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="form-layout.html" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Form Layout</span>
                            </a>
                        </li>

                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-pen-fill"></i>
                                <span>Form Editor</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active">
                                    <a href="form-editor-quill.html">Quill</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-editor-ckeditor.html">CKEditor</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-editor-summernote.html">Summernote</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="form-editor-tinymce.html">TinyMCE</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="table.html" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Table</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="table-datatable.html" class='sidebar-link'>
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>Datatable</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Extra UI</li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-pentagon-fill"></i>
                                <span>Widgets</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="ui-widgets-chatbox.html">Chatbox</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="ui-widgets-pricing.html">Pricing</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="ui-widgets-todolist.html">To-do List</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-egg-fill"></i>
                                <span>Icons</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="ui-icons-bootstrap-icons.html">Bootstrap Icons </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="ui-icons-fontawesome.html">Fontawesome</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="ui-icons-dripicons.html">Dripicons</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-bar-chart-fill"></i>
                                <span>Charts</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="ui-chart-chartjs.html">ChartJS</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="ui-chart-apexcharts.html">Apexcharts</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="ui-file-uploader.html" class='sidebar-link'>
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                                <span>File Uploader</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-map-fill"></i>
                                <span>Maps</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="ui-map-google-map.html">Google Map</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="ui-map-jsvectormap.html">JS Vector Map</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Pages</li>

                        <li class="sidebar-item  ">
                            <a href="application-email.html" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Email Application</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="application-chat.html" class='sidebar-link'>
                                <i class="bi bi-chat-dots-fill"></i>
                                <span>Chat Application</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="application-gallery.html" class='sidebar-link'>
                                <i class="bi bi-image-fill"></i>
                                <span>Photo Gallery</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="application-checkout.html" class='sidebar-link'>
                                <i class="bi bi-basket-fill"></i>
                                <span>Checkout Page</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Authentication</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="auth-login.html">Login</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="auth-register.html">Register</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="auth-forgot-password.html">Forgot Password</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-x-octagon-fill"></i>
                                <span>Errors</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="error-403.html">403</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="error-404.html">404</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="error-500.html">500</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Raise Support</li>

                        <li class="sidebar-item  ">
                            <a href="https://zuramai.github.io/mazer/docs" class='sidebar-link'>
                                <i class="bi bi-life-preserver"></i>
                                <span>Documentation</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="https://github.com/zuramai/mazer/blob/main/CONTRIBUTING.md" class='sidebar-link'>
                                <i class="bi bi-puzzle"></i>
                                <span>Contribute</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="https://github.com/zuramai/mazer#donate" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Donate</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
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
                                    <li class="breadcrumb-item"><a href="index.html">الصفحة الرئيسة</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">إدارة بيان الشركة</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>

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
                            $result = $con->query($sql);

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
                                <i class="bi bi-plus-circle" style=" margin-left: 5px; "></i>  إضافة بند جديد
                                </button>

                            </div>
                        </div>
                    </div>
                </section>



            </div>



            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>



        </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: #DF0500">
                        <h5 class="modal-title" id="deleteModalLabel" style="width:50% font-family: 'Cairo', sans-serif;"> تأكيد الحذف </h5>

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

   







    </div>


    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        let deleteId = null;

        function showAlert(message, type) {
            const messageContainer = document.getElementById('message');
            const tableWidth = document.querySelector('.table-responsive').clientWidth;

            messageContainer.innerHTML = `
        <div class="alert alert-${type} alert-dismissible show fade" style="width: 685px;">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> `;
        }


        function showDeleteModal(id) {
            deleteId = id;
            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {});
            deleteModal.show();
        }

        document.getElementById('confirmDeleteButton').addEventListener('click', function () {
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
                });
        }


    </script>

</body>

</html>