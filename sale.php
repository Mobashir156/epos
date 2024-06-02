<?php
include('config/app.php');
include('SalesReport.php');

header('Content-Type: application/json');

$conn = new DatabaseConnection();
$db = $conn->getConnection();
$salesReport = new SalesReport($db);
$invoiceNumber = $salesReport->generateInvoiceNumber();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize POST data
    $barcode = isset($_POST['product_barcode']) ? $_POST['product_barcode'] : [];
    $pname = isset($_POST['product_name']) ? $_POST['product_name'] : [];
    $user_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
    $qty = isset($_POST['qty']) ? $_POST['qty'] : [];
    $price = isset($_POST['sub_buy']) ? $_POST['sub_buy'] : [];
    $discount = isset($_POST['discount']) ? $_POST['discount'] : null;
    $shipping = isset($_POST['shipping']) ? $_POST['shipping'] : null;
    $c_paid = isset($_POST['paid']) ? $_POST['paid'] : null;
    $due = isset($_POST['due']) ? $_POST['due'] : null;
    $sales_id = $invoiceNumber;
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $remark = isset($_POST['remark']) ? $_POST['remark'] : null;
    $total = isset($_POST['total']) ? $_POST['total'] : [];
    $salesman = isset($_POST['salesman']) ? $_POST['salesman'] : null;
    $product_ids = isset($_POST['product_id']) ? $_POST['product_id'] : [];
    $courier = isset($_POST['courier_id']) ? $_POST['courier_id'] : [];

    // SQL statement with placeholders
    $sql = "INSERT INTO `sales`(`barcode`, `pname`, `user_id`, `qty`, `price`, `discount`, `shipping`, `c_paid`, `due`, `sales_id`, `status`, `remark`, `total`, `salesman`, `product_id`, `courier_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $errors = [];
    foreach ($product_ids as $index => $product_id) {
        $params = [
            ['type' => 's', 'value' => $barcode[$index]],
            ['type' => 's', 'value' => $pname[$index]],
            ['type' => 'i', 'value' => $user_id],
            ['type' => 'd', 'value' => $qty[$index]],
            ['type' => 'd', 'value' => $price[$index]],
            ['type' => 'd', 'value' => $discount],
            ['type' => 'd', 'value' => $shipping],
            ['type' => 'd', 'value' => $c_paid],
            ['type' => 'd', 'value' => $due],
            ['type' => 's', 'value' => $sales_id],
            ['type' => 'i', 'value' => $status],
            ['type' => 's', 'value' => $remark],
            ['type' => 'd', 'value' => $total[$index]],
            ['type' => 'i', 'value' => $salesman],
            ['type' => 'i', 'value' => $product_id],
            ['type' => 'i', 'value' => $courier],
        ];

        if (!$conn->executeStatement($sql, $params)) {
            $errors[] = "Error: Failed to add product for product ID $product_id.";
        }
    }

    if (empty($errors)) {
        if ($status != 2) { 
            $updateSuccess = updateCustomerBalanceAndDue($db, $user_id, $c_paid, $due);
            if ($updateSuccess) {
                echo json_encode(['message' => 'All products added successfully and customer balance updated!']);
            } else {
                echo json_encode(['message' => 'All products added successfully, but failed to update customer balance.']);
            }
        } else {
            echo json_encode(['message' => 'All products added successfully. No balance update for pending status.']);
        }
    } else {
        echo json_encode(['errors' => $errors]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

// Close the connection
$conn->close();

function updateCustomerBalanceAndDue($db, $user_id, $paid, $due) {
    // Retrieve current balance and due
    $stmt = $db->prepare("SELECT balance, due FROM customers WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($currentBalance, $currentDue);
    $stmt->fetch();
    $stmt->close();

    // Calculate new balance and due
    if ($currentBalance >= $paid) {
        $newBalance = $currentBalance - $paid;
        $cashPaid = 0;
    } else {
        $cashPaid = $paid - $currentBalance;
        $newBalance = 0;
    }
    
    $newDue = $currentDue + $due;

    // Update balance and due in the database
    $updateStmt = $db->prepare("UPDATE customers SET balance = ?, due = ? WHERE id = ?");
    $updateStmt->bind_param("ddi", $newBalance, $newDue, $user_id);
    $success = $updateStmt->execute();
    $updateStmt->close();

    return $success;
}
?>
