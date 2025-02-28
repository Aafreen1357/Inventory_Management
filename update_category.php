<?php 
include("common/db_connection.php");
    $category_id=$_GET['category_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $category_id; ?></h1>
    <?php 
    $select_query="SELECT c_name FROM categories WHERE id=$category_id"; 
    $result=mysqli_query($conn, $select_query);
    while($row=mysqli_fetch_assoc($result)){
    ?>
    <form action="update_category.php" method="post">
        <input type="text" name="category_name" value="<?php echo $row['c_name']; ?>">
        <input type="submit" value="Update">
    </form>
    <?php
    }
    ?>
</body>
</html>