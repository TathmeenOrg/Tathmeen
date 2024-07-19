<?php
include('config.php');
session_start();

if (isset($_GET['financialOffer_id'])) {
    $file_id = intval($_GET['financialOffer_id']);

    // إعداد استعلام الاسترجاع
    $stmt = $conn->prepare("SELECT file_name, file_data FROM financialOffers WHERE financialOffer_id = ?");
    $stmt->bind_param('i', $file_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($fileName, $fileData);

    if ($stmt->fetch()) {
        // تحديث حالة التنزيل
        $stmt_update = $conn->prepare("UPDATE financialOffers SET file_download_status = 1 WHERE financialOffer_id = ?");
        $stmt_update->bind_param('i', $file_id);
        $stmt_update->execute();
        $stmt_update->close();

        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf'); 
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($fileData));

        echo $fileData;
    } else {
        echo 'الملف غير موجود.';
    }

    $stmt->close();
} else {
    echo 'معرف الملف غير صحيح.';
}

$conn->close();
?>
