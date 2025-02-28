<?php
    include('common/db_connection.php');
    $query = "SELECT product_id, product_name, category_id, subcategory_id, product_price, product_description,manufacture_date, expiry_date, status FROM product";
    $result = mysqli_query($conn, $query);
    $count=0;
    if($_SERVER['REQUEST_METHOD']==='POST'){
        if(isset($_POST['statusToggle']))
        {
            $count++;
            $product_id=$_POST['product_id'];
            $status=$_POST['status'];
            $setValue=($status==='1')?0:1;
            $update_query= "UPDATE product set status='$setValue' where product_id='$product_id'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>event.preventDefault();</script>";
                $count=0;
            } else {
                echo "Error updating status: " . mysqli_error($conn);
            }
        }
        else if(isset($_POST["delete"]))
        {
            $product_id=$_POST['product_id'];
            $delete_query= "DELETE FROM product WHERE product_id=$product_id";
            if (mysqli_query($conn, $delete_query)) {
                echo "<script>event.preventDefault();</script>";
            } else {
                echo "Error deleting category: " . mysqli_error($conn);
            }
        }
    }
?>
<script src="https://cdn.tailwindcss.com"></script>
<title>Products View</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styleHome.css">
<body class="bg-gradient-to-tr from-[#21D4FD] to-[#B721FF]">
<div class="flex flex-col gap-4">
        <header class="mb-2">
            <nav class="flex flex-col md:flex-row md:justify-between">
                <button type="button" onclick="ToggleMenu();" id="menuButton" class="w-20">
                    <img src="images/menu.png" width="60px" height="60px" alt="logo" id="hideViewToggle" class="md:hidden p-2">
                </button>
                <div id="menuO" class="md:block hidden ">
                    <ul class="md:flex md:flex-row w-full bg-white md:bg-transparent text-blue-600 md:text-white text-lg font-bold flex-col w-full gap-4 md:justify-between md:block">
                        <li class="p-2"><a href="home.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Home</a></li>
                        <li class="p-2"><a href="Category.php" class="w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Category</a></li>
                        <li class="p-2"><a href="SubCategory.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Sub-Category</a></li>
                        <li class="p-2"><a href="Vendors.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Vendors</a></li>
                        <li class="p-2"><a href="Product.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Product</a></li>
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Customer</a></li>
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Order</a></li>
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">About me</a></li>
                    </ul>  
                </div>         
            </nav>  
        </header>
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
        <div class="flex flex-row justify-center gap-5 ">
            <div class="bg-white bg-opacity-50 rounded p-3">
                <button type="button">
                    <img src="images\tune.png" title="Filter" style='width: 50px; height: 50px;' >
                </button>
                <button type="button">
                    <img src="images\search.png" title="Search" style='width: 50px; height: 50px;'>
                </button>
                <button type="button">
                    <img src="images\filter_list_off.png" title="Filter_off" style='width: 50px; height: 50px;'>
                </button>
            </div>
        </div>
        <div class="flex flex-col items-center gap-5">
            
        </div>
    <div class="w-full flex flex-row justify-center p-4">
        <?php
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='border p-4 rounded bg-white text-blue-600'>
                        <tr>
                            <th class='border border-blue-400 p-2'>Product Name</th>
                            <th class='border border-blue-400 p-2'>Category</th>
                            <th class='border border-blue-400 p-2'>Price</th>
                            <th class='border border-blue-400 p-2'>Descrpition</th>
                            <th class='border border-blue-400 p-2'>Status</th>
                            <th class='border border-blue-400 p-2'>Delete</th>
                        </tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_category_query="SELECT c_name FROM categories WHERE category_id= '{$row['category_id']}'";
                    $product_category_result= mysqli_query($conn, $product_category_query);
                    $product_category_row = mysqli_fetch_assoc($product_category_result);
                    if($row['status']==1)
                    {
                        $statusImage="active.png";
                    }
                    else{
                        $statusImage= "inactive.png";
                    }
                    // $statusImage = ($row['status'] == 1) ? 'images/active.png' : 'images/inactive.png';
                    echo "<tr>
                            <td class='border border-blue-400 p-2'>
                                <div>
                                    <input type='text' value='{$row['product_name']}' id='product_name_{$row['product_id']}' class='p-2' disabled>
                                    <button type='submit' name='statusToggle' onClick='setEnabled({$row['product_id']},\"name\");'>
                                            <img src='images/edit.png' id='editImg' title='Edit Name' alt='edit' style='width: 20px; height: 15px;'>
                                    </button>
                                </div>
                            </td>
                            <td class='border border-blue-400 p-2'>
                                    {$product_category_row['c_name']}
                            </td>
                            <td class='border border-blue-400 p-2'>{$row['product_price']}</td>
                            <td class='border border-blue-400 p-2'>
                                <div class='flex flex-row gap-2'> 
                                        <span class='hidden md:inline'><input type='text' value='{$row['product_description']}' id='product_des_{$row['product_id']}' class='p-2'/></span>
                                        <span class='md:hidden'><input type='text' value='" . substr($row['product_description'], 0, 10) . "...' id='product_des_{$row['product_id']}' class='w-[80%] md:w-full' /></span>
                                    
                                    <button type='submit' name='statusToggle' class='hidden md:block' onClick='setEnabled({$row['product_id']},\"description\");'>
                                            <img src='images/edit.png' title='Edit' alt='edit' style='width: 20px; height: 15px;'>
                                    </button>
                                </div>
                                
                            </td>
                            <form method='POST' action=''>
                            <td class='border border-blue-400 p-2'>
                            
                                <input type='hidden' name='product_id' value='".$row['product_id']."'>
                                <input type='hidden' name='status' value='".$row['status']."'>
                                <button type='submit' name='statusToggle'>
                                    <img src='images/{$statusImage}' alt='status' style='width: 50px; height: 50px;'>
                                </button>
                            
                            </td> 
                            <td>
                                <input type='hidden' name='product_id' value='".$row['product_id']."'>
                                <button type='submit' name='delete' class='bg-red-500 rounded p-2 text-white hover:bg-red-800'>Remove</button>
                            </td>       
                            </form>
                        </tr>";
                }
                echo "</table>";
            } 
            else {
                echo "No product found.";
            }
        ?>
    </div>
</div>   
</body>
<script>
    function setEnabled(productId,specifyWhat)
    {
        if(specifyWhat==='name')
        {
            var inputBox = document.getElementById('product_name_' + productId);
            var imageTag=document.getElementById('editImg');
            if (inputBox) {
                imageTag.src="images/save.png";
                inputBox.disabled = false;
                inputBox.focus();
                inputBox.addEventListener('keydown',function(event){
                    if(event.key=='Enter'){
                        updateProduct(productId,'product_name',inputBox.value);
                    }
                });
                
            }
        }
        else {
            var inputBox = document.getElementById('product_des_' + productId);
            if (inputBox) {
                inputBox.disabled = false;
                inputBox.focus();
                inputBox.addEventListener('keydown',function(event){
                    if(event.key=='Enter'){
                        updateProduct(productId,'product_description',inputBox.value)
                    }
                });
            }
        }

        function updateProduct(productId,specifyWhat,value)
        {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "updateProduct.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // alert("Product updated successfully");
                    location.reload();
                }
            };
            xhr.send("product_id=" + productId + "&specifyWhat=" + specifyWhat + "&value=" + value);
        }
    }
</script>
<?php 
    mysqli_close($conn);
?>
