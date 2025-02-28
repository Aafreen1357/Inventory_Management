<?php
    include("common/db_connection.php");
    if( ISSET($_POST["addProduct"]))
    {
        echo "<script>event.preventDefault();</script>";
        $pname= $_POST["pname"];
        $pdes= $_POST["pdes"];
        $pprice= $_POST["pprice"];
        $category_id= $_POST["selected_category"];
        $sub_category_id=$_POST["subCategory"];
        $mdate=$_POST["mdate"];
        $edate= $_POST["edate"];
        $save_msg="Enter Data";
        $search_query="SELECT * FROM product where product_name='$pname 'and category_id=$category_id;";
        $search_result=mysqli_query($conn,$search_query);
        if(mysqli_num_rows($search_result)> 0)
        {
            echo "<script>event.preventDefault();</script>";
            $save_msg="Already Exists";
        }
        else{
            $insert_query="INSERT INTO product(product_name,product_description,product_price,category_id,subcategory_id,manufacture_date,expiry_date,status)VALUES('$pname','$pdes','$pprice','$category_id','$sub_category_id','$mdate','$edate',1);";
            $result=mysqli_query($conn,$insert_query);
            if(mysqli_affected_rows($conn)>0){
                echo "<script>event.preventDefault();</script>";
                $save_msg="Successfully Added!";
            }
        }
        
    }
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory Management-Product</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styleHome.css">
<script src="https://cdn.tailwindcss.com"></script> 
<script>
    function getSubCategory()
    {
        var cat_id=document.getElementById('selectedCategory').value;
        var query="category_id= " + cat_id;
        var var1 = new XMLHttpRequest();
        var1.open("POST","getSubcategory.php",false);
        var1.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var1.send(query);
        document.getElementById("subCategory").innerHTML=var1.responseText;
    }

</script>
<body class="bg-gradient-to-tr from-[#21D4FD] to-[#B721FF]">
    <!-- Main Container Starts here -->
    <div class="flex flex-col gap-4">
        <!-- Header Starts here -->
        <header class="mb-2">
            <!-- Nav Bar -->
            <nav class="flex flex-col md:flex-row md:justify-between">
                <!-- ToggleMenu here -->
                <button type="button" onclick="ToggleMenu();" id="menuButton" class="w-20">
                    <img src="images/menu.png" width="60px" height="60px" alt="logo" id="hideViewToggle" class="md:hidden p-2">
                </button>
                <!-- Anchor tags here -->
                <div id="menuO" class="md:block hidden ">
                    <ul class="md:flex md:flex-row w-full bg-white md:bg-transparent text-blue-600 md:text-white text-lg font-bold flex-col w-full gap-4 md:justify-between md:block">
                        <li class="p-2"><a href="home.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Home</a></li>
                        <li class="p-2"><a href="Category.php" class="w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Category</a></li>
                        <li class="p-2"><a href="SubCategory.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Sub-Category</a></li>
                        <li class="p-2"><a href="Vendors.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Vendors</a></li>
                        <li class="p-2"><a href="Product.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Product</a></li>
                        <li class="p-2"><a href="Customer.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Customer</a></li>
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Order</a></li>
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">About me</a></li>
                    </ul>  
                </div>         
            </nav>  
        </header>
        <!-- second div for user name -->
        <div class="flex flex-row justify-end ">
                <?php
                session_start();
                if (isset($_SESSION['user_name'])) {
                    echo "<p class='text-white text-lg p-2 hover:scale-x-105 transition-duration-300'>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</p>";
                } else {
                    echo "<p class='text-white text-lg p-2 hover:scale-x-105 transition-duration-300'>Welcome, Guest!</p>";
                }
                ?>
        </div>
        <!-- here div is for inserting a product -->
        <div class=" m-4 text-blue-600 flex flex-col items-center">
           <form class="w-full md:w-[60%] bg-white rounded" method="POST">
                <div class="text-center text-2xl p-4">
                    Add a product
                </div>
                <div class="p-4 flex flex-col justify-center items-center gap-4">
                    <input type="text" placeholder="Product name" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400" name="pname">
                    <input type="text" placeholder="Product Description" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400" name="pdes">
                    <input type="text" placeholder="Product Price" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400" name="pprice">
                    <div class="flex flex-row w-full gap-2">
                        <select class="w-full border-b border-blue-600 p-2" name="selected_category" id="selectedCategory" onChange="getSubCategory();">
                            <?php
                            $select_category_query="SELECT category_id,c_name from categories;";
                            $select_category_result=mysqli_query($conn,$select_category_query);
                            while($row=mysqli_fetch_assoc($select_category_result))
                            {
                                echo "<option value='".$row['category_id']."'>".$row['c_name']."</option>";
                            }
                            ?>
                        </select>
                        <select class="w-full border-b border-blue-600 p-2" name="subCategory" id="subCategory">
                            <script>getSubCategory();</script>
                        </select>
                    </div> 
                    <div class="grid grid-cols-2 items-center w-full">
                        <label for="mdate" class="text-left">Manufacture Date:</label>
                        <input type="date" name="mdate" id="mdate" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400">
                    </div> 
                    <div class="grid grid-cols-2 items-center w-full">
                        <label for="edate" class="text-left">Expiry Date:</label>
                        <input type="date" name="edate" id="edate" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400">
                    </div>   
                    <div class="flex flex-row justify-center gap-4 w-full">
                        <button type="submit" name="addProduct" class="p-2 bg-blue-600 rounded text-white w-[45%] hover:bg-green-600">Save</button>
                        <a href="viewProducts.php" target="_blank" class="w-[45%]"><button type="button" class="p-2 bg-blue-600 rounded text-white hover:bg-[#B721FF] w-full">View All</button></a>
                    </div>
                </div> 
           </form> 
           <div class="text-white text-xl">
                <?php $save_msg ?>
           </div>
        </div>
    </div>
</body>