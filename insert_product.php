<?php
include('config/app.php');
$conn = new DatabaseConnection;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['barcode']) && isset($_POST['product_name']) && isset($_POST['product_category']) && isset($_POST['unit_type']) && isset($_POST['buy_rate']) && isset($_POST['retail_price']) && isset($_POST['wholesale_price'])) {
        $barcode = $_POST['barcode'];
        $product_name = $_POST['product_name'];
        $product_category = $_POST['product_category'];
        $unit_type = $_POST['unit_type'];
        $buy_rate = $_POST['buy_rate'];
        $retail_price = $_POST['retail_price'];
        $wholesale_price = $_POST['wholesale_price'];
        $opening_stock = isset($_POST['opening_stock']) ? $_POST['opening_stock'] : 0;
        
        $targetDir = "uploads/";
        $fileName = basename($_FILES["product_img"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if (in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["product_img"]["tmp_name"], $targetFilePath)){
                // Prepare SQL statement
                $sql = "INSERT INTO products (barcode, pname, category_id, unit, buy_rate, retail_price, whole_price, opening, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                
                // Define parameters and their types
                $params = [
                    ['type' => 's', 'value' => $barcode],
                    ['type' => 's', 'value' => $product_name],
                    ['type' => 'i', 'value' => $product_category],
                    ['type' => 's', 'value' => $unit_type],
                    ['type' => 'd', 'value' => $buy_rate],
                    ['type' => 'd', 'value' => $retail_price],
                    ['type' => 'd', 'value' => $wholesale_price],
                    ['type' => 'i', 'value' => $opening_stock],
                    ['type' => 's', 'value' => $targetFilePath]
                ];
                
                // Execute the statement
                if ($conn->executeStatement($sql, $params)) {
                    echo "Product added successfully!";
                } else {
                    echo "Error: Failed to add product.";
                }
            } else {
                echo "Error: There was an error uploading your file.";
            }
        } else {
            echo "Error: Only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        echo "All required fields are not set.";
    }
} else {
    echo "Invalid request method.";
}
?>
