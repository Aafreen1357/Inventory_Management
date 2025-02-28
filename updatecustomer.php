<?php
// updatecustomer.php

// Database connection
include("common/db_connection.php");
// Check if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $specifyWhat = $_POST['specifyWhat'];
    $value = $_POST['value'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE customer SET $specifyWhat = ? WHERE customer_id = ?");
    $stmt->bind_param("si", $value, $customer_id);

    if ($stmt->execute()) {
        echo "customer updated successfully";
    } else {
        echo "Error updating customer: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>