<?php
include('config/app.php');
include('Product.php');

header('Content-Type: application/json');
ob_start();

if (isset($_GET['query'])) {
    $db = new DatabaseConnection();
    $product = new Product($db);

    $query = $_GET['query'];
    $products = $product->searchProducts($query);

    $db->close();

    // Clear the buffer and return JSON response
    ob_end_clean();
    echo json_encode(['products' => $products]);
} else {
    // Clear the buffer and return an error response
    ob_end_clean();
    echo json_encode(['error' => 'No query parameter provided']);
}

?>
