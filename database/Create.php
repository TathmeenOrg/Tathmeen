<?php
include('config.php');


mysqli_set_charset($conn, "utf8");


$sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    age INT NOT NULL,
    role ENUM('super_admin', 'sub_admin') NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
   security_code VARCHAR(255) NULL
);

CREATE TABLE IF NOT EXISTS financialOffers (
    financialOffer_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    created_at DATE NOT NULL,
    association_name VARCHAR(255) NOT NULL,
    client_address VARCHAR(255) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    total_price DECIMAL(20, 2) NOT NULL,
    file_download_status BOOLEAN NOT NULL DEFAULT 0,
    file_data LONGBLOB DEFAULT NULL, 
    FOREIGN KEY (user_id) REFERENCES users(id)
);


CREATE TABLE IF NOT EXISTS statements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    statement_description TEXT
);

CREATE TABLE IF NOT EXISTS services (
    financialOffer_id INT NOT NULL,
    user_id INT NOT NULL,
    service VARCHAR(255) NOT NULL,
    service_price DECIMAL(20, 2) NOT NULL,
    quantity INT NOT NULL,
    total_service_price DECIMAL(20, 2) NOT NULL,
    PRIMARY KEY (financialOffer_id, user_id, service),  
    FOREIGN KEY (financialOffer_id) REFERENCES financialOffers(financialOffer_id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);


CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    financial_offer_id INT NOT NULL,
    payment_percentage DECIMAL(5, 2) NOT NULL,
    payment_number INT NOT NULL,
    FOREIGN KEY (financial_offer_id) REFERENCES financialOffers(financialOffer_id)
);

";


if (mysqli_multi_query($conn, $sql)) {
    echo "Tables created successfully\n";
} else {
    echo "Error: " . mysqli_error($conn);
}


mysqli_close($conn);
?>
