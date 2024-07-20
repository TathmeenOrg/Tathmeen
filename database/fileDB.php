<?php
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['pdf']) && isset($_POST['financialOffer_id']) && isset($_POST['user_id'])) {
        $financialOffer_id = intval($_POST['financialOffer_id']);
        $user_id = intval($_POST['user_id']);

        // التحقق من نوع الملف
        if ($_FILES['pdf']['type'] !== 'application/pdf') {
            echo 'الملف يجب أن يكون بصيغة PDF';
            exit;
        }

        if ($_FILES['pdf']['error'] !== UPLOAD_ERR_OK) {
            echo 'حدث خطأ أثناء تحميل الملف';
            exit;
        }

        $fileName = $_FILES['pdf']['name'];
        $fileData = file_get_contents($_FILES['pdf']['tmp_name']);

        $stmt = $conn->prepare("UPDATE financialOffers SET file_name = ?, file_data = ? WHERE financialOffer_id = ? AND user_id = ?");
        $stmt->bind_param('ssii', $fileName, $fileData, $financialOffer_id, $user_id);

        if ($stmt->execute()) {
            echo 'تم حفظ الملف بنجاح!';
        } else {
            echo 'حدث خطأ أثناء حفظ الملف: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        echo 'بيانات غير كافية';
    }
} else {
    echo 'الطلب غير صحيح.';
}

$conn->close();
?>
