<?php
// update-company-info.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = array(
        'company_name' => $_POST['company_name'] ?? '',
        'description' => $_POST['description'] ?? '',
        'location' => $_POST['location'] ?? '',
        'contact_number' => $_POST['contact_number'] ?? '',
        'instagram_account' => $_POST['instagram_account'] ?? '',
        'twitter_account' => $_POST['twitter_account'] ?? '',
        'email' => $_POST['email'] ?? '',
        'snapchat_account' => $_POST['snapchat_account'] ?? '',
        'whatsapp_number' => $_POST['whatsapp_number'] ?? '',
        'bank_name' => $_POST['bank_name'] ?? '',
        'iban_number' => $_POST['iban_number'] ?? ''
    );

    // قراءة ملف JSON وتحديثه
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    if (file_put_contents('../company_info.json', $json_data)) {
        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error'));
    }
}
?>
