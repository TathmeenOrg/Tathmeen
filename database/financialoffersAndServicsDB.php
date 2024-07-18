<?php
include('config.php');
session_start();

$service = null;
$price = null;
$quantity = null;
$total_service_price = null;
$total_price = 0;
$association_name = null;
$created_at = null;
$client_address = null;
$user_id = 1;




if (isset($_POST['submitBu'])) {

    $association_name = $_POST['association_name'];
    $created_at = $_POST['created_at'];
    $client_address = $_POST['client_address'];
    $services = $_POST['service'];
    $prices = $_POST['service_price'];
    $quantities = $_POST['quantity'];
    $total_service_prices = $_POST['total_service_price'];


    $stmt = $con->prepare("INSERT INTO financialoffers (user_id, created_at, association_name, client_address, file_download_status, total_price) VALUES (?, ?, ?, ?, ?, ?)");
    $file_download_status = 0;
    $stmt->bind_param("isssii", $user_id, $created_at, $association_name, $client_address, $file_download_status, $total_price);

    if ($stmt->execute() === FALSE) {
        exit; 
    } else {
        $_SESSION['offer_id'] = $stmt->insert_id;
    }

    $offer_id = $_SESSION['offer_id'];

    for ($i = 0; $i < count($services); $i++) {
        $service = $services[$i];
        $price = $prices[$i];
        $quantity = $quantities[$i];
        $total_service_price = $total_service_prices[$i];

        $stmt = $con->prepare("INSERT INTO services (user_id, financialOffer_id, service, service_price, quantity, total_service_price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisdid", $user_id, $offer_id, $service, $price, $quantity, $total_service_price);

        if ($stmt->execute() === FALSE) {
            echo "Error inserting service: " . $stmt->error;
            echo "Service: $service, Price: $price, Quantity: $quantity, Total Service Price: $total_service_price, Offer ID: $offer_id<br>";
        } else {
            $total_price += $total_service_price;
            echo "Service inserted successfully. Service ID: " . $stmt->insert_id . ", Offer ID: " . $offer_id . "<br>";
        }
    }

    // تحديث total_price في جدول financialoffers
    $stmt = $con->prepare("UPDATE financialoffers SET total_price = ? WHERE financialOffer_id = ?");
    $stmt->bind_param("di", $total_price, $offer_id);
    if ($stmt->execute() === FALSE) {
        echo "Error updating total price: " . $stmt->error;
    } else {
        echo "Total price updated successfully for Offer ID: " . $offer_id;
    }

    /* $step_completed=true;
    $_SESSION['step_completed'] = $step_completed; */
    // header('Location: ../dist/financialOffersForm.php');
    
    exit;
}



$con->close();
?>
