<?php
include('../database/config.php');
session_start();

$user_id = $_SESSION['user_id'];

$query_role = "SELECT role FROM users WHERE id = ?";
$stmt_role = $conn->prepare($query_role);
$stmt_role->bind_param("i", $user_id);
$stmt_role->execute();
$result_role = $stmt_role->get_result();

$user_role = '';
if ($result_role->num_rows > 0) {
    $row_role = $result_role->fetch_assoc();
    $user_role = $row_role['role'];
}

$stmt_role->close();

if ($user_role == 'super_admin') {
    $query_offers = "SELECT MONTH(created_at) as month, COUNT(*) as total_offers 
                     FROM financialoffers 
                     WHERE YEAR(created_at) = YEAR(CURDATE())
                     GROUP BY MONTH(created_at)";
} else if ($user_role == 'sub_admin') {
    $query_offers = "SELECT MONTH(created_at) as month, COUNT(*) as total_offers 
                     FROM financialoffers 
                     WHERE YEAR(created_at) = YEAR(CURDATE()) AND user_id = ?
                     GROUP BY MONTH(created_at)";
} else {
    echo json_encode(array_fill(0, 12, 0));
    exit;
}

$stmt_offers = $conn->prepare($query_offers);

if ($user_role == 'sub_admin') {
    $stmt_offers->bind_param("i", $user_id);
}

$stmt_offers->execute();
$result_offers = $stmt_offers->get_result();

$data_offers = array_fill(0, 12, 0);

if ($result_offers->num_rows > 0) {
    while ($row = $result_offers->fetch_assoc()) {
        $data_offers[intval($row['month']) - 1] = $row['total_offers'];
    }
}

$stmt_offers->close();

//  بيانات الجنس
$query_gender = "SELECT 
                   SUM(CASE WHEN gender = 'male' THEN 1 ELSE 0 END) AS male_count,
                   SUM(CASE WHEN gender = 'female' THEN 1 ELSE 0 END) AS female_count
                 FROM users";

$result_gender = $conn->query($query_gender);

$data_gender = [0, 0];

if ($result_gender->num_rows > 0) {
    $row_gender = $result_gender->fetch_assoc();
    $data_gender = [(int)$row_gender['male_count'], (int)$row_gender['female_count']];
}

$conn->close();


echo json_encode([
    'offers' => $data_offers,
    'gender' => $data_gender
]);
?>
