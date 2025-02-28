<?php
// updateProduct.php

// Database connection
include("common/db_connection.php");
// Check if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $specifyWhat = $_POST['specifyWhat'];
    $value = $_POST['value'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE product SET $specifyWhat = ? WHERE product_id = ?");
    $stmt->bind_param("si", $value, $product_id);

    if ($stmt->execute()) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>