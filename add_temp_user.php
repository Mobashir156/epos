<?php
include 'config/app.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the POST data
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    // Create a new database connection
    $db = new DatabaseConnection();
    $conn = $db->getConnection();

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO customers (name, mobile, address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $mobile, $address);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Fetch the ID of the newly inserted user
        $newUserId = $stmt->insert_id;

        echo json_encode([
            'success' => true,
            'customer_id' => $newUserId,
            'mobile' => $mobile,
        ]);

    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
