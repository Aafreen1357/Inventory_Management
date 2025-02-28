<?php
    $category_id=$_POST["category_id"];
    include("common/db_connection.php");
    $select_category_query="select sub_category_id,sc_name from sub_categories where category_id=$category_id;";
    $str="";
    $result=mysqli_query($conn,$select_category_query);
    if(mysqli_num_rows($result)> 0){
        while($row=mysqli_fetch_assoc($result)){
            $str=$str."<option value=".$row['sub_category_id'].">".$row["sc_name"]."</option>";
        }
    }
    print $str;
?>