<?php
include('config.php');

mysqli_set_charset($conn, "utf8");

$sql = "
INSERT INTO users (email, firstname, lastname, gender, age, role, phone_number, password)
VALUES ('Superadmin@asbq.dev', 'Super', 'admin', 'male', 25, 'super_admin', '0534067890', 'S3cur3P@ssw0rd!'),
ON DUPLICATE KEY UPDATE 
    email = VALUES(email),
    role = VALUES(role),
    phone_number = VALUES(phone_number),
    password = VALUES(password);

INSERT INTO statements (statement_description)
VALUES
('الأسعار الموضحة في الجدول بالريال السعودي.'),
('العرض صالح لمدة ٣ أيام عمل من تاريخ العرض.'),
('تمديد فترة اشتراك الدعم الفني يتطلب رسوم إضافية.')
ON DUPLICATE KEY UPDATE statement_description = VALUES(statement_description);

";

if (mysqli_multi_query($conn, $sql)) {
    echo "تم تنفيذ الاستعلامات بنجاح\n";
} else {
    echo "خطأ: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
