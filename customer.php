<?php
include 'config/app.php';

$db = new DatabaseConnection;

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    $result = $db->fetchBalance($customer_id);
    echo json_encode([
        'balance' => $result['balance'],
        'previous_due' => $result['due']
    ]);
} else {
    $customers = $db->fetchcustomers();
    $customerOptions = [];

    foreach ($customers as $customer) {
        $customerOptions[] = [
            'id' => $customer['id'],
            'name' => $customer['name']
        ];
    }

    echo json_encode(['customers' => $customerOptions]);
}
?>
