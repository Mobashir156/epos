<?php
include('config/app.php');

$conn = new DatabaseConnection();
$db = $conn->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize POST data
    $d_ate = isset($_POST['d_ate']) ? $_POST['d_ate'] : null;
    $invoice_no = isset($_POST['invoice_no']) ? $_POST['invoice_no'] : null;
    $supplier_id = isset($_POST['supplier_id']) ? $_POST['supplier_id'] : null;
    $sub_total = isset($_POST['sub_total']) ? $_POST['sub_total'] : null;
    $total = isset($_POST['total']) ? $_POST['total'] : null;
    $commission = isset($_POST['commission']) ? $_POST['commission'] : null;
    $shipping = isset($_POST['shipping']) ? $_POST['shipping'] : null;
    $payable = isset($_POST['payable']) ? $_POST['payable'] : null;
    $paid = isset($_POST['paid']) ? $_POST['paid'] : null;
    $due = isset($_POST['due']) ? $_POST['due'] : null;
    $comment = isset($_POST['comment']) ? $_POST['comment'] : null;
    $product_ids = isset($_POST['product_id']) ? $_POST['product_id'] : [];
    $expire_dates = isset($_POST['expire_date']) ? $_POST['expire_date'] : [];
    $quantities = isset($_POST['qty']) ? $_POST['qty'] : [];

    // SQL statement with placeholders
    $sql = "INSERT INTO `purchases` (`d_ate`, `invoice_no`, `supplier_id`, `sub_total`, `total`, `commission`, `shipping`, `paid`, `due`, `comment`, `product_id`, `exp_date`, `qty`, `payable`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Loop through products and insert them into the database
    foreach ($product_ids as $index => $product_id) {
        $params = [
            ['type' => 's', 'value' => $d_ate],
            ['type' => 's', 'value' => $invoice_no],
            ['type' => 'i', 'value' => $supplier_id],
            ['type' => 'd', 'value' => $sub_total],
            ['type' => 'd', 'value' => $total],
            ['type' => 'd', 'value' => $commission],
            ['type' => 'd', 'value' => $shipping],
            ['type' => 'd', 'value' => $paid],
            ['type' => 'd', 'value' => $due],
            ['type' => 's', 'value' => $comment],
            ['type' => 'i', 'value' => $product_id],
            ['type' => 's', 'value' => $expire_dates[$index]],
            ['type' => 'i', 'value' => $quantities[$index]],
            ['type' => 's', 'value' => $payable]
        ];

        if ($conn->executeStatement($sql, $params)) {
            echo "Product added successfully for product ID $product_id!<br>";
        } else {
            echo "Error: Failed to add product for product ID $product_id.<br>";
        }
    }
} else {
    echo "No form data submitted.";
}

// Close the connection
$conn->close();
?>
