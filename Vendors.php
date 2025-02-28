<?php
    include("common/db_connection.php");
    if(isset($_POST['addVendor']))
    {
        echo "<script>event.preventDefault();</script>";
        $save_msg="";
        $v_name=trim($_POST['vendor_name']);
        $v_email=trim($_POST['vendor_email']);
        $v_phone=trim($_POST['vendor_phone']);
        $country_code=$_POST['country_code'];
        $v_address=trim($_POST['vendor_address']);
        $v_category=trim($_POST['vendor_category']);
        $search_query="SELECT * from vendors where v_name='$v_name' and v_category='$v_category'";
        $search_result=mysqli_query($conn,$search_query);
        if(mysqli_num_rows($search_result)> 0)
        {
            $save_msg="Record already exists";
        }
        else
        {
            if (preg_match('/\d/', $v_name)) 
            {
                $save_msg = "Name doesn't contain numbers";
            } 
            else {
                $insert_query= "INSERT INTO vendors(v_name,v_email,country_code,v_phone,v_address,v_category) VALUES('$v_name','$v_email','$country_code','$v_phone','$v_address','$v_category')";
                $insert_result=mysqli_query($conn,$insert_query);
                if(mysqli_affected_rows($conn) > 0)
                {
                    $save_msg= "Record Successfully inserted";
                }
                else
                {
                    $save_msg= "Record not saved.";
                }
            }
        }
    }
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inventory Management</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styleHome.css">
<script src="https://cdn.tailwindcss.com"></script> 

<body class="bg-gradient-to-tr from-[#21D4FD] to-[#B721FF]">
    
    <!-- Main Container Starts here -->
    <div class="flex flex-col gap-4">
        <!-- Header Starts here -->
        <header class="mb-2">
            <!-- Nav Bar -->
            <nav class="flex flex-col md:flex-row md:justify-between">
                <div>
                    <!-- ToggleMenu here -->
                    <button type="button" onclick="ToggleMenu();" id="menuButton" class="w-20">
                        <img src="images/menu.png" width="60px" height="60px" alt="logo" id="hideViewToggle" class="md:hidden p-2">
                    </button>
                    <!-- dark light theme toggle button here -->
                    <button type="button" onclick="ToggleTheme()" id="toggleTheme">
                        <img src="images/dark_mode.png" width="60px" height="60px" alt="logo" id="hideViewToggle" class=" mt-1 rounded">
                    </button>
                </div>
                
                <!-- Anchor tags here -->
                <div id="menuO" class="md:block hidden ">
                    <ul class="md:flex md:flex-row w-full bg-white md:bg-transparent text-blue-600 md:text-white text-lg font-bold flex-col w-full gap-4 md:justify-between md:block">
                        <li class="p-2"><a href="home.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2  hover:text-black hover:bg-white hover:bg-opacity-50">Home</a></li>
                        <li class="p-2"><a href="Category.php" class="w-full border-b-2 border-blue-600 md:border-0 p-2  hover:text-black hover:bg-white hover:bg-opacity-50">Category</a></li>
                        <li class="p-2"><a href="SubCategory.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 hover:text-black hover:bg-white hover:bg-opacity-50">Sub-Category</a></li>
                        <li class="p-2"><a href="Vendors.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2  hover:text-black hover:bg-white hover:bg-opacity-50">Vendors</a></li>
                        <li class="p-2"><a href="Product.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2  hover:text-black hover:bg-white hover:bg-opacity-50">Product</a></li>
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2  hover:text-black hover:bg-white hover:bg-opacity-50">Customer</a></li>
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2  hover:text-black hover:bg-white hover:bg-opacity-50">Order</a></li>
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2  hover:text-black hover:bg-white hover:bg-opacity-50">About me</a></li>
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
        <!-- Following code is for vendors input -->
        <div class="p-4">
            <form action="vendors.php" method="POST" id="vendorForm" class=" bg-white rounded-lg border border-white grid grid-cols-2 gap-4 p-4">
                <label for="vendor_name" id="vnameLabel" class="text-blue-600">Vendor Name</label>
                <input type="text" name="vendor_name" id="vendor_name" class="p-2 border rounded border-blue-600 text-blue-600 placeholder-grey-700" placeholder="Supplier Name" required>
                <label for="vendor_email" id="vemailLabel" class="text-blue-600">Vendor Email</label>
                <input type="email" name="vendor_email" id="vendor_email" class="p-2 border rounded border-blue-600 text-blue-600 placeholder-grey-700" placeholder="Supplier Email" required>
                <label for="vendor_phone" id="vphoneLabel" class="text-blue-600">Vendor Phone</label>
                <div>
                    <select name="country_code" id="countryCode" class="border border-blue-400 text-blue-600 rounded m-2 p-2 w-[40%] md:w-[21%]" required>
                        <option value="+91">+91 (India)</option>
                        <option value="+1">+1 (USA)</option>
                        <option value="+44">+44 (UK)</option>
                        <option value="+91">+92 (Pakistan)</option>
                    </select>
                    <input type="text" name="vendor_phone" id="vendor_phone" class="p-2 border rounded border-blue-600 placeholder-grey-700" placeholder="Supplier Phone" pattern="\d{10}" title="enter correct number" required>
                </div>
                
                <label for="vendor_address" id="vaddressLabel" class="text-blue-600">Vendor Address</label>
                <textarea name="vendor_address" id="vendor_address" class="p-2 border rounded border-blue-600 text-blue-600"></textarea>
                <label for="vendor_category" id="vcategoryLabel" class="text-blue-600">Category</label>
                <select name="vendor_category" id="vendor_category" class="p-2 border text-blue-600 rounded border-blue-600">
                    <?php
                        $category_select="select category_id, c_name from categories";
                        $result=mysqli_query( $conn, $category_select);
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['category_id']."'>".$row['c_name']."</option>";
                        }
                    ?>
                </select>
                <input type="submit" value="Add Vendor" name="addVendor" id="addVendor" class="bg-blue-600 text-white p-2 rounded hover:bg-green-500 ">
                <input type="button" value="Clear" id="clearField" class="bg-blue-600 text-white p-2 rounded hover:bg-red-500">
                <a href="viewVendors.php"><input type="button" value="View Suppliers" name="viewVendor" id="addVendor" class="bg-blue-600 text-white p-2 rounded hover:bg-opacity-50 hover:text-blue-600"></a>               
            </form>
            <?php 
                if (isset($save_msg)) {
                    echo "<p class='text-white text-center text-xl hover:text-blue-600 hover:bg-white p-2 hover:bg-opacity-70 rounded'>$save_msg</p>";
                }
            ?>
        </div>
    </div>
</body>
<script>
    window.addEventListener('resize', function() {
        var menu = document.getElementById("menuO");
        if (window.innerWidth >= 768) { 
            menu.style.display = "block";
        }
        else{
            menu.style.display = "none";
        }
    });
    function ToggleMenu(){
        var menu = document.getElementById("menuO");
        if(menu.style.display === "none"){
            menu.style.display = "block";
        }
        else{
            menu.style.display = "none";
        }
    }
    function ToggleTheme()
    {
        var body = document.body;
        var addVendor=document.getElementById('addVendor');
        var clearField = document.getElementById('clearField');
        var labels = document.querySelectorAll('label');
        var selectBoxes=document.querySelectorAll('select');
        var inputs= document.querySelectorAll('input');
        var vendorForm = document.getElementById('vendorForm');
        var vendorAddress = document.getElementById('vendor_address');
        if (body.style.background !== "linear-gradient(to right, #000428, #004e92)") {
            body.style.background = "linear-gradient(to right, #000428, #004e92)";
            addVendor.style.background = "grey";     
            vendorForm.style.background = "rgba(255, 255, 255, 0.5)";
            inputs.forEach(function(input) {
                input.style.border = "none";
                input.style.borderBottom = "2px solid black";
                input.style.borderRadius = "1";
                input.style.backgroundColor='white';
                input.style.color = "black";
                input.style.opacity = "0.5";
                input.style.borderColor = "black";
                input.classList.add('dark-placeholder');
            });
            selectBoxes.forEach(function(selectBox){
                selectBox.style.border="none";
                selectBox.style.borderBottom="2px solid black";
                selectBox.style.backgroundColor="white";
                selectBox.style.opacity="0.5";
                selectBox.style.color="black";
            });
            labels.forEach(function(label) {
                label.style.color = "white";
            });
            vendorAddress.style.backgroundColor='white';
            vendorAddress.style.opacity="0.5";
            vendorAddress.style.border="1px solid black"
            clearField.style.background = "grey";
        } else {
            body.style.background = "linear-gradient(to right, #21D4FD, #B721FF)";
            
        }
    }
</script>