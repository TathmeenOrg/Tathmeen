<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <?php
    include('../database/config.php');
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: auth-login.php");
        exit();
        // comment لو سمحت سجل دخول
    }
    //اسم الصفحه حاليّا
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام تثمين | إدارة معلومات الشركة</title>
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
                            <h3>إدارة معلومات الشركة</h3>
                            <p class="text-subtitle text-muted">يمكنك الآن تحديث المعلومات الخاصة بالشركة..</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start ">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">الصفحة الرئيسية</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">إدارة معلومات الشركة</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="mx-auto col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-6">
                                <h4 class="mb-10 text-center">نموذج تعديل معلومات الشركة</h4>
                            </div>
                            <div id="success-alert" class="alert alert-success d-none" role="alert">
                                <i class="bi bi-check-circle"></i> تم حفظ التغييرات بنجاح!
                            </div>
                            <div id="error-alert" class="alert alert-danger d-none" role="alert">
                                <i class="bi bi-x-circle"></i> حدث خطأ، يرجى المحاولة مرة أخرى.
                            </div>

                            <?php
                            // read JSON file
                            $json_data = file_get_contents('../company_info.json');
                            // convert data to array
                            $company_info = json_decode($json_data, true);
                            ?>
                            <form id="company_info_form" action="/Applications/MAMP/htdocs/Tathmeen/dist/update-company-info.php" method="post">
                                <!-- Basic Information Section -->
                                <div class="mb-6">
                                    <h5 class="mb-4">معلومات الشركة الأساسية</h5>
                                </div>
                                <div class="mb-3 row">
                                    <label for="company_name" class="col-sm-3 col-form-label">اسم الشركة</label>
                                    <div class="col-sm-9">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input type="text" id="company_name" name="company_name" class="form-control" value="<?php echo htmlspecialchars($company_info['company_name']); ?>" required>
                                                <div class="form-control-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                                                        <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z" />
                                                        <path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-3 col-form-label">وصف الشركة</label>
                                    <div class="col-sm-9">
                                        <textarea id="description" name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($company_info['description']); ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="location" class="col-sm-3 col-form-label">موقع الشركة</label>
                                    <div class="col-sm-9">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input id="location" name="location" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['location']); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="contact_number" class="col-sm-3 col-form-label">رقم التواصل</label>
                                    <div class="col-sm-9">
                                        <div class="form-group has-icon-left">
                                            <div class="position-relative">
                                                <input id="contact_number" name="contact_number" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['contact_number']); ?>" required>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-telephone"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Social Media Section -->
                                <div class="mb-6 mt-5">
                                    <h5 class="mb-3">حسابات التواصل الاجتماعي</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3 row">
                                            <label for="instagram_account" class="col-sm-7 col-form-label">حساب instagram</label>
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="col">
                                                        <input id="instagram_account" name="instagram_account" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['instagram_account']); ?>" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-instagram"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="twitter_account" class="col-sm-7 col-form-label">حساب X/Twitter</label>
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="col">
                                                        <input id="twitter_account" name="twitter_account" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['twitter_account']); ?>" required>
                                                        <div class="form-control-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                                                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="col-sm-7 col-form-label">البريد الالكتروني</label>
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="col">
                                                        <input id="email" name="email" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['email']); ?>" required>
                                                        <div class="form-control-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z" />
                                                                <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                            <label for="snapchat_account" class="col-sm-7 col-form-label">حساب Snapchat</label>
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="col">
                                                        <input id="snapchat_account" name="snapchat_account" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['snapchat_account']); ?>" required>
                                                        <div class="form-control-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-snapchat" viewBox="0 0 16 16">
                                                                <path d="M15.943 11.526c-.111-.303-.323-.465-.564-.599a1 1 0 0 0-.123-.064l-.219-.111c-.752-.399-1.339-.902-1.746-1.498a3.4 3.4 0 0 1-.3-.531c-.034-.1-.032-.156-.008-.207a.3.3 0 0 1 .097-.1c.129-.086.262-.173.352-.231.162-.104.289-.187.371-.245.309-.216.525-.446.66-.702a1.4 1.4 0 0 0 .069-1.16c-.205-.538-.713-.872-1.329-.872a1.8 1.8 0 0 0-.487.065c.006-.368-.002-.757-.035-1.139-.116-1.344-.587-2.048-1.077-2.61a4.3 4.3 0 0 0-1.095-.881C9.764.216 8.92 0 7.999 0s-1.76.216-2.505.641c-.412.232-.782.53-1.097.883-.49.562-.96 1.267-1.077 2.61-.033.382-.04.772-.036 1.138a1.8 1.8 0 0 0-.487-.065c-.615 0-1.124.335-1.328.873a1.4 1.4 0 0 0 .067 1.161c.136.256.352.486.66.701.082.058.21.14.371.246l.339.221a.4.4 0 0 1 .109.11c.026.053.027.11-.012.217a3.4 3.4 0 0 1-.295.52c-.398.583-.968 1.077-1.696 1.472-.385.204-.786.34-.955.8-.128.348-.044.743.28 1.075q.18.189.409.31a4.4 4.4 0 0 0 1 .4.7.7 0 0 1 .202.09c.118.104.102.26.259.488q.12.178.296.3c.33.229.701.243 1.095.258.355.014.758.03 1.217.18.19.064.389.186.618.328.55.338 1.305.802 2.566.802 1.262 0 2.02-.466 2.576-.806.227-.14.424-.26.609-.321.46-.152.863-.168 1.218-.181.393-.015.764-.03 1.095-.258a1.14 1.14 0 0 0 .336-.368c.114-.192.11-.327.217-.42a.6.6 0 0 1 .19-.087 4.5 4.5 0 0 0 1.014-.404c.16-.087.306-.2.429-.336l.004-.005c.304-.325.38-.709.256-1.047m-1.121.602c-.684.378-1.139.337-1.493.565-.3.193-.122.61-.34.76-.269.186-1.061-.012-2.085.326-.845.279-1.384 1.082-2.903 1.082s-2.045-.801-2.904-1.084c-1.022-.338-1.816-.14-2.084-.325-.218-.15-.041-.568-.341-.761-.354-.228-.809-.187-1.492-.563-.436-.24-.189-.39-.044-.46 2.478-1.199 2.873-3.05 2.89-3.188.022-.166.045-.297-.138-.466-.177-.164-.962-.65-1.18-.802-.36-.252-.52-.503-.402-.812.082-.214.281-.295.49-.295a1 1 0 0 1 .197.022c.396.086.78.285 1.002.338q.04.01.082.011c.118 0 .16-.06.152-.195-.026-.433-.087-1.277-.019-2.066.094-1.084.444-1.622.859-2.097.2-.229 1.137-1.22 2.93-1.22 1.792 0 2.732.987 2.931 1.215.416.475.766 1.013.859 2.098.068.788.009 1.632-.019 2.065-.01.142.034.195.152.195a.4.4 0 0 0 .082-.01c.222-.054.607-.253 1.002-.338a1 1 0 0 1 .197-.023c.21 0 .409.082.49.295.117.309-.04.56-.401.812-.218.152-1.003.638-1.18.802-.184.169-.16.3-.139.466.018.14.413 1.991 2.89 3.189.147.073.394.222-.041.464" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="whatsapp_number" class="col-sm-7 col-form-label">رقم تواصل WhatsApp</label>
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="col">
                                                        <input id="whatsapp_number" name="whatsapp_number" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['whatsapp_number']); ?>" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-whatsapp"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Bank Accounts Section -->
                                <div class="mb-6 mt-5">
                                    <h5 class="mb-3">الحسابات البنكية</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3 row">
                                            <label for="bank_name" class="col-sm-7 col-form-label">اسم البنك</label>
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="col">
                                                        <input id="bank_name" name="bank_name" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['bank_name']); ?>" required>
                                                        <div class="form-control-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16">
                                                                <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3 row">
                                            <label for="iban_number" class="col-sm-3 col-form-label">رقم الـIBAN</label>
                                            <div class="form-group has-icon-left">
                                                <div class="position-relative">
                                                    <div class="col">
                                                        <input id="iban_number" name="iban_number" type="text" class="form-control" value="<?php echo htmlspecialchars($company_info['iban_number']); ?>" required>
                                                        <div class="form-control-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hash" viewBox="0 0 16 16">
                                                                <path d="M8.39 12.648a1 1 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1 1 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.51.51 0 0 0-.523-.516.54.54 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532s.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531s.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br><br>
                                <!-- Edit Button -->
                                <div class="row">
                                    <div class="col-sm-12 mx-auto">
                                        <button type="button" id="edit_button" class="btn btn-warning btn-block">تعديل معلومات الشركة</button>
                                    </div>
                                </div>
                                <br>
                                <!-- Save Button -->
                                <div class="row">
                                    <div class="col-sm-12 mx-auto">
                                        <button type="button" id="save_button" class="btn btn-primary btn-block">حفظ التغييرات</button>
                                    </div>
                                </div>
                            </form>
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
                        <p>2024 &copy; Tathmeen</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>



    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        // Function to display selected image
        function displaySelectedImage(event, elementId) {
            var output = document.getElementById(elementId);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src);
            }
        }
    </script>
    <script>
        document.getElementById('formFile').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var img = document.getElementById('preview');
                img.src = reader.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var editButton = document.getElementById("edit_button");
            var saveButton = document.getElementById("save_button");
            var inputs = document.querySelectorAll(".form-control");
            var alertContainer = document.getElementById("alert_container");

            if (editButton && saveButton && inputs.length > 0) {
                saveButton.style.display = "none";

                inputs.forEach(function(input) {
                    input.disabled = true;
                });

                editButton.addEventListener("click", function() {
                    editButton.style.display = "none";
                    saveButton.style.display = "block";
                    inputs.forEach(function(input) {
                        input.disabled = false;
                    });
                });

                saveButton.addEventListener("click", function(event) {
                    editButton.style.display = "block";
                    saveButton.style.display = "none";
                    event.preventDefault();
                    var form = document.querySelector("#company_info_form");
                    if (form) {
                        var formData = new FormData(form);

                        fetch("update-company-info.php", {
                                method: "POST",
                                body: formData
                            }).then(response => response.json())
                            .then(data => {
                                var successAlert = document.getElementById('success-alert');
                                var errorAlert = document.getElementById('error-alert');

                                if (data.status === "success") {
                                    successAlert.classList.remove('d-none');
                                    setTimeout(function() {
                                        successAlert.classList.add('d-none');
                                    }, 5000);
                                } else {
                                    errorAlert.classList.remove('d-none');
                                    setTimeout(function() {
                                        errorAlert.classList.add('d-none');
                                    }, 5000);
                                }
                            }).catch(error => {
                                showAlert("حدث خطأ، حاول مرة أخرى.", "danger");
                            });
                    } else {
                        console.error('Form not found');
                    }
                });
            } else {
                console.error('Edit button, save button, or form controls not found');
            }

            function showAlert(message, type) {
                alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
                setTimeout(() => {
                    alertContainer.innerHTML = '';
                }, 5000);
            }
        });
    </script>
</body>

</html>