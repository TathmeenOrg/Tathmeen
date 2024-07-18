<?php
include('config.php');

mysqli_set_charset($con, "utf8");

$sql = "
INSERT INTO users (email, firstname, lastname, gender, age, role, phone_number, password)
VALUES ('Superadmin@asbq.dev', 'Super', 'admin', 'male', 25, 'super_admin', '0534067890', 'S3cur3P@ssw0rd!'),
ON DUPLICATE KEY UPDATE 
    email = VALUES(email),
    role = VALUES(role),
    phone_number = VALUES(phone_number),
    password = VALUES(password);
/* 
INSERT INTO financialOffers (user_id, created_at, association_name, client_address, file_name, total_price, file_download_status)
VALUES (1, '2024-07-17', 'مؤسسة النهضة', 'شارع الملك فهد، الرياض', 'offer1.pdf', 1500.00000, 1),
       (1, '2024-07-17', 'شركة الوفاء العالمية', 'شارع الملك عبدالعزيز، جدة', 'offer2.pdf', 2500.00000, 0),
       (1, '2024-07-18', 'شركة الأمل الواعد', 'شارع الملك سلمان، الدمام', 'offer3.pdf', 1800.00000, 0),
       (1, '2024-07-18', 'مؤسسة الإبداع العربي', 'شارع الملك خالد، الطائف', 'offer4.pdf', 3000.00000, 1),
       (1, '2024-07-19', 'شركة التطور الرقمي', 'شارع الملك عبدالله، المدينة', 'offer5.pdf', 2800.00000, 0),
       (2, '2024-07-19', 'مؤسسة القوة الوطنية', 'شارع الملك سعود، حائل', 'offer6.pdf', 2200.00000, 0),
       (2, '2024-07-20', 'شركة العزم الجديد', 'شارع الملك خالد، الرياض', 'offer7.pdf', 1900.00000, 1),
       (2, '2024-07-20', 'مؤسسة الريادة العربية', 'شارع الملك فيصل، جدة', 'offer8.pdf', 3200.00000, 0),
       (2, '2024-07-21', 'شركة الإتقان العالمية', 'شارع الملك عبدالعزيز، الرياض', 'offer9.pdf', 2600.00000, 0),
       (2, '2024-07-21', 'مؤسسة الوحدة الوطنية', 'شارع الملك سلمان، الدمام', 'offer10.pdf', 3400.00000, 0);
 */
INSERT INTO statements (statement_description)
VALUES
('الأسعار الموضحة في الجدول بالريال السعودي.'),
('العرض صالح لمدة ٣ أيام عمل من تاريخ العرض.'),
('تمديد فترة اشتراك الدعم الفني يتطلب رسوم إضافية.')
ON DUPLICATE KEY UPDATE statement_description = VALUES(statement_description);

";

if (mysqli_multi_query($con, $sql)) {
    echo "تم تنفيذ الاستعلامات بنجاح\n";
} else {
    echo "خطأ: " . mysqli_error($con);
}

mysqli_close($con);
?>
