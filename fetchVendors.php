<?php
include ("common/db_connection.php"); // Include your database connection file
echo "<script> alert('Yo');</script>";
if (isset($_POST['vname'])) {
    echo "<script> alert('Yo');</script>";
    $vname = $_POST['vname'];
    $query = "SELECT v_name FROM vendors WHERE v_name LIKE '%$vname%'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . htmlspecialchars($row['v_name']) . "'>" . htmlspecialchars($row['v_name']) . "</option>";
        }
    }
    else{
        echo "<script> alert('$vname');</script>";
    }
}
?>