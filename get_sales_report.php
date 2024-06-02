<?php
include('config/app.php');

include('SalesReport.php');

header('Content-Type: application/json');

$customerId = isset($_GET['customer_id']) ? $_GET['customer_id'] : null;

if ($customerId) {
    $database = new DatabaseConnection();
    $salesReport = new SalesReport($database);
    echo json_encode($salesReport->getSalesReport($customerId));
} else {
    echo json_encode(['error' => 'Customer ID is required']);
}
?>
