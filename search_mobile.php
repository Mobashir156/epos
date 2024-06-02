<?php
include('config/app.php');
include('include/Search.php');

header('Content-Type: application/json');
ob_start();

if (isset($_GET['query'])) {
    $db = new DatabaseConnection();
    $mobile = new Search($db);

    $query = $_GET['query'];
    $mobiles = $mobile->searchcustomer($query);

    $db->close();

    // Clear the buffer and return JSON response
    ob_end_clean();
    echo json_encode(['mobiles' => $mobiles]);
} else {
    // Clear the buffer and return an error response
    ob_end_clean();
    echo json_encode(['error' => 'No query parameter provided']);
}

?>