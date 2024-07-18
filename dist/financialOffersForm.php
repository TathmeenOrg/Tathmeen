<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>financial offers form</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
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

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-pen-fill"></i>
                                <span>Form Editor</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
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

                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-egg-fill"></i>
                                <span>Icons</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active">
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
                            <p class="text-subtitle text-muted" style="font-family: 'Cairo', sans-serif;">إنشاء عرض مالي جديد</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start ">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">الصفحة الرئيسة</a></li>
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
                                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Step 1">
                                    <a class="nav-link1 active rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        href="#step1" id="step1-tab" data-bs-toggle="tab" role="tab"
                                        aria-controls="step1" aria-selected="true">
                                        1
                                    </a>
                                </li>
                                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Step 2">
                                    <a class="nav-link1 rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        href="#step2" id="step2-tab" data-bs-toggle="tab" role="tab"
                                        aria-controls="step2" aria-selected="false">
                                        2
                                    </a>
                                </li>
                                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Step 3">
                                    <a class="nav-link1 rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        href="#step3" id="step3-tab" data-bs-toggle="tab" role="tab"
                                        aria-controls="step3" aria-selected="false">
                                        3
                                    </a>
                                </li>
                                <li class="nav-item flex-fill" role="presentation" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Step 4">
                                    <a class="nav-link1 rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        href="#step4" id="step4-tab" data-bs-toggle="tab" role="tab"
                                        aria-controls="step4" aria-selected="false">
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

                        <form class="form form-horizontal" id="financialoffersForm" method="POST"
                            action="../database/financialoffersAndServicsDB.php">
                            <div class="tab-content" id="myTabContent">


                                <div class="tab-pane fade show active" role="tabpanel" id="step1"
                                    aria-labelledby="step1-tab" style="margin-top: 25px;">
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
                                                                        <input type="text" id="first-name"
                                                                            class="form-control" name="association_name"
                                                                            placeholder="أدخل اسم الشركة" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>تاريخ إنشاء العرض</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <input type="date" id="creation-date"
                                                                            class="form-control" name="created_at"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>عنوان العميل</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <input type="text" id="contact-info"
                                                                            class="form-control" name="client_address"
                                                                            placeholder="أدخل عنوان العميل" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-lg btn-primary rounded-pill back mx-2"
                                                        style="pointer-events: none; opacity: 0.6;"><i
                                                            class="fas fa-angle-right"></i> السابق</button>
                                                    <button type="button"
                                                        class="btn btn-lg btn-primary rounded-pill next mx-2">التالي <i
                                                            class="fas fa-angle-left"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="step2" aria-labelledby="step2-tab"
                                    style="margin-top: 25px;">
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
                                                                        <td><input type="text" name="service[]"
                                                                                class="form-control service"
                                                                                placeholder="أدخل الخدمة" required></td>
                                                                        <td><input type="number" name="service_price[]"
                                                                                class="form-control rate"
                                                                                placeholder="أدخل سعر الخدمة" min="0"
                                                                                pattern="[0-9]*" required></td>
                                                                        <td><input type="number" name="quantity[]"
                                                                                class="form-control quantity"
                                                                                placeholder="أدخل الكمية" min="0"
                                                                                pattern="[0-9]*" required></td>
                                                                        <td><input type="number"
                                                                                name="total_service_price[]"
                                                                                class="form-control total"
                                                                                placeholder="السعر الإجمالي" readonly>
                                                                        </td>

                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="3" style="font-weight: bold;">السعر
                                                                            الإجمالي</td>
                                                                        <td><input type="number" class="form-control"
                                                                                id="overallTotal"
                                                                                style="background-color: transparent; border: transparent; font-weight: bold;"
                                                                                readonly></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary mt-3"
                                                            id="addRow">إضافة خدمة</button>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button"
                                                        class="btn btn-lg btn-primary rounded-pill back mx-2"><i
                                                            class="fas fa-angle-right"></i> السابق</button>
                                                    <button type="button"
                                                        class="btn btn-lg btn-primary rounded-pill next mx-2">التالي <i
                                                            class="fas fa-angle-left"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>






                                <!-- //------------------------------------  Mannnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnar :  -->

                                <div class="tab-pane fade" role="tabpanel" id="step3" aria-labelledby="step3-tab"
                                    style="margin-top: 25px;">
                                    <h3 class="text-center">القسم الثالث</h3>

                                    <section id="basic-horizontal-layouts">
                                        <div class="row justify-content-center">
                                            <div class="col-md-8 col-12">
                                                <div class="card">
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
                                                              $result = $con->query($sql);
                
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
                                                    <button type="button"
                                                        class="btn btn-lg btn-primary rounded-pill back mx-2"><i
                                                            class="fas fa-angle-right"></i> السابق</button>
                                                    <button type="button"
                                                        class="btn btn-lg btn-primary rounded-pill next mx-2">التالي
                                                        <i class="fas fa-angle-left"></i></button>
                                                </div>

                                            </div>
                                        </div>

                                    </section>
                                </div>




                                <div class="tab-pane fade" role="tabpanel" id="step4" aria-labelledby="step4-tab"
                                    style="margin-top: 25px;">
                                    <h3 class="text-center">القسم الرابع</h3>

                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-lg btn-primary rounded-pill back mx-2"><i
                                                class="fas fa-angle-right"></i> السابق</a>
                                        <button type="submit" name="submitBu"
                                            class="btn btn-lg btn-primary rounded-pill  mx-2">حفظ وإنهاء<i
                                                class="fas fa-angle-left"></i></button>
                                    </div>
                                </div>




                            <!--     <div class="tab-pane fade" role="tabpanel" id="step5" aria-labelledby="step5-tab"
                                    style="margin-top: 25px;">
                                    <h3 class="text-center">القسم الخامس</h3>



                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-lg btn-primary rounded-pill back mx-2"><i
                                                class="fas fa-angle-right"></i> السابق</button>
                                        <button type="button"
                                            class="btn btn-lg btn-primary rounded-pill next mx-2">التالي
                                            <i class="fas fa-angle-left"></i></button>
                                    </div>
                                </div> -->
                            </div>

                        </form>
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
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('step1-tab').click();
        });

        // Service Table Calculations
        document.addEventListener('DOMContentLoaded', function () {
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

            document.getElementById('addRow').addEventListener('click', function () {
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

                newRow.querySelector('.removeRow').addEventListener('click', function () {
                    newRow.remove();
                    calculateOverallTotal();
                });
            });

            document.querySelectorAll('#serviceTable .rate, #serviceTable .quantity').forEach(input => {
                input.addEventListener('input', function () {
                    const row = input.closest('tr');
                    calculateRowTotal(row);
                });
            });

            document.querySelectorAll('#serviceTable .removeRow').forEach(button => {
                button.addEventListener('click', function () {
                    const row = button.closest('tr');
                    row.remove();
                    calculateOverallTotal();
                });
            });

            calculateOverallTotal();
        });

        // Automatically set the current date in the date input field
        document.addEventListener('DOMContentLoaded', function () {
            const creationDateInput = document.getElementById('creation-date');
            const today = new Date().toISOString().split('T')[0];
            creationDateInput.value = today;
        });


    </script>






    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/mazer.js"></script>
</body>

</html>