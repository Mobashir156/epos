<?php
include('config/app.php');

include('SalesReport.php');

if(isset($_GET['uniqueid'])) {
    $uniqueid = intval($_GET['uniqueid']);

    $db = new databaseConnection();
    $salesReport = new SalesReport($db);

    $stmt = $db->getConnection()->prepare("SELECT * FROM sales WHERE sales_id = ?");
    $stmt->bind_param("i", $uniqueid);
    $stmt->execute();
    $result = $stmt->get_result();

    $sales_data = [];
    while ($row = $result->fetch_assoc()) {
        $sales_data[] = [
            'id' => $row['id'],
            'product_id' => $row['product_id'],
            'barcode' => $row['barcode'],
            'pname' => $row['pname'],
            'qty' => $row['qty'],
            'price' => $row['price'],
            'discount' => $row['discount'],
            'total' => $row['total']
        ];
    }

    if (count($sales_data) > 0) {
        echo json_encode(['status' => 'success', 'data' => $sales_data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No sales data found for the uniqueid.']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Uniqueid parameter is missing.']);
}
?>
