<?php
include('config.php');

// تعيين الترميز إلى utf8mb4
mysqli_set_charset($con, "utf8");

// استعلامات SQL لإنشاء الجداول
$sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'sub_admin') NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    UNIQUE KEY (email)
);

CREATE TABLE IF NOT EXISTS financial_offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    created_at DATE NOT NULL,
    association_name VARCHAR(255) NOT NULL,
    client_address VARCHAR(255) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    file_download_status BOOLEAN NOT NULL DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS statements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    financial_offer_id INT,
    statement_description TEXT,
    FOREIGN KEY (financial_offer_id) REFERENCES financial_offers (id)
);

CREATE TABLE IF NOT EXISTS services (
    financial_offer_id INT NOT NULL,
    user_id INT NOT NULL,
    service_price DECIMAL(20, 5) NOT NULL,
    quantity INT NOT NULL,
    total_service_price DECIMAL(20, 5) NOT NULL,
    PRIMARY KEY (financial_offer_id, user_id),
    FOREIGN KEY (financial_offer_id) REFERENCES financial_offers(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
";


if (mysqli_multi_query($con, $sql)) {
    echo "Tables created successfully\n";
} else {
    echo "Error: " . mysqli_error($con);
}


mysqli_close($con);
?>
