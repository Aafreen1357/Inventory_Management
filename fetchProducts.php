<?php
include 'db_connection.php'; // Include your database connection file

// Check if the database connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the 'productName' parameter is set
if (isset($_POST['productName'])) {
    $productName = $_POST['productName'];
    error_log("Received productName: " . $productName); // Log the received productName for debugging

    $query = "SELECT product_name FROM products WHERE product_name LIKE '%$productName%'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . htmlspecialchars($row['product_name']) . "'>" . htmlspecialchars($row['product_name']) . "</option>";
            }
        } else {
            echo "<option value=''>No products found</option>";
        }
    } else {
        error_log("Query failed: " . mysqli_error($conn)); // Log the query error for debugging
    }
} else {
    error_log("productName parameter not set"); // Log if the productName parameter is not set
}
?>