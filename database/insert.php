<?php
include('config.php');

// تعيين الترميز إلى utf8
mysqli_set_charset($con, "utf8");

// استعلامات SQL لإدخال البيانات
$sql = "
INSERT INTO users (email, role, phone_number, name, password) VALUES 
('Superadmin@asbq.dev', 'super_admin', '0534567890', 'Superadmin', 'S3cur3P@ssw0rd!')
ON DUPLICATE KEY UPDATE email = VALUES(email), role = VALUES(role), phone_number = VALUES(phone_number), name = VALUES(name), password = VALUES(password);

INSERT INTO financial_offers (user_id, created_at, association_name, client_address, file_name, total_price, file_download_status)
VALUES (1, '2024-07-15', 'اسم الجمعية', 'عنوان العميل', 'اسم الملف.pdf', 1500.00, 0);

INSERT INTO statements (financial_offer_id, statement_description)
VALUES
(1, 'الأسعار الموضحة في الجدول بالريال السعودي.'),
(1, 'العرض صالح لمدة ٣ أيام عمل من تاريخ العرض.'),
(1, 'تمديد فترة اشتراك الدعم الفني يتطلب رسوم إضافية.')
ON DUPLICATE KEY UPDATE statement_description = VALUES(statement_description);
";


if (mysqli_multi_query($con, $sql)) {
    echo "Queries executed successfully\n";
} else {
    echo "Error: " . mysqli_error($con);
}


mysqli_close($con);
?>
