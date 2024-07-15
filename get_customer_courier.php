<?php
include('config/app.php');

if (isset($_GET['uniqueid'])) {
    $uniqueid = $_GET['uniqueid'];

    // Fetch customer and courier data based on the uniqueid
    $stmt = $db->prepare("SELECT * FROM sales WHERE sales_id = ?");
    $stmt->bind_param("i", $uniqueid);
    $stmt->execute();
    $result = $stmt->get_result();
    $sale = $result->fetch_assoc();
    $stmt->close();

    if ($sale) {
        $response = [];

        // Fetch customer data
        $customerStmt = $db->prepare("SELECT id, name FROM customers WHERE id = ?");
        $customerStmt->bind_param("i", $sale['user_id']);
        $customerStmt->execute();
        $customerResult = $customerStmt->get_result();
        $customer = $customerResult->fetch_assoc();
        $customerStmt->close();

        if ($customer) {
            $response['customer'] = $customer;
        }

        // Fetch courier data
        $courierStmt = $db->prepare("SELECT id, name FROM couriers WHERE id = ?");
        $courierStmt->bind_param("i", $sale['courier_id']);
        $courierStmt->execute();
        $courierResult = $courierStmt->get_result();
        $courier = $courierResult->fetch_assoc();
        $courierStmt->close();

        if ($courier) {
            $response['courier'] = $courier;
        }

        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Sale not found']);
    }
}
?>
