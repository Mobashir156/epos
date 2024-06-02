<?php
include 'config/app.php';

$db = new DatabaseConnection;

    // Fetch all suppliers
    $couriers = $db->fetchcourier();
    $options = '';
    foreach ($couriers as $courier) {
        $options .= '<option value="' . $courier['id'] . '">' . $courier['name'] . '</option>';
    }
    echo $options;

?>
