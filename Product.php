<?php
class Product {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function searchProducts($query) {
    $stmt = $this->db->prepare("SELECT id, barcode, pname AS name, buy_rate, retail_price, whole_price FROM products WHERE pname LIKE ? OR barcode LIKE ?");
    $searchQuery = "%" . $query . "%";
    $stmt->bind_param("ss", $searchQuery, $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();
    return $products;
}

}
?>
