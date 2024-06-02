<?php
include 'config/app.php';

$db = new DatabaseConnection;

if (isset($_GET['supplier_id'])) {
    // Fetch due amount for a specific supplier
    $supplier_id = $_GET['supplier_id'];
    $due_amount = $db->fetchDueAmount($supplier_id);
    echo json_encode(['previous_due' => $due_amount]);
} else {
    // Fetch all suppliers
    $suppliers = $db->fetchSuppliers();
    $options = '';
    foreach ($suppliers as $supplier) {
        $options .= '<option value="' . $supplier['id'] . '">' . $supplier['name'] . '</option>';
    }
    echo $options;
}
?>
