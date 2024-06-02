<?php
include 'config/app.php';

$db = new DatabaseConnection;

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    $result = $db->fetchBalance($customer_id);
    echo json_encode(['balance' => $result['balance'], 'previous_due' => $result['due']]);
} else {
    
    $customers = $db->fetchcustomers();
    $options = '';
    foreach ($customers as $customer) {
        $options .= '<option value="' . $customer['id'] . '">' . $customer['name'] . '</option>';
    }
    echo $options;
}
?>
