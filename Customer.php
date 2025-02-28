<?php
    include('common/db_connection.php');
    $save_msg="Enter Data";
    if( ISSET($_POST["addCustomer"]))
    {
        echo "<script>event.preventDefault();</script>";
        $cname= $_POST["cname"];
        $cphone= $_POST["cphone"];
        $cadd= $_POST["cadd"];
        $cmail= $_POST["cemail"];
        $bdate=$_POST["bdate"];      
        $search_query="SELECT * FROM customer where customer_contact=$cphone;";
        $search_result=mysqli_query($conn,$search_query);
        if(mysqli_num_rows($search_result)> 0)
        {
            echo "<script>event.preventDefault();</script>";

            $save_msg="Customer Already Exists";
        }
        else{
            if (preg_match_all("/[a-zA-Z ]+/",$cname))
            {
                $insert_query="INSERT INTO customer(customer_name,customer_address,customer_mail,customer_contact,customer_bdate)VALUES('$cname','$cadd','$cmail','$cphone','$bdate');";
                $result=mysqli_query($conn,$insert_query);
                if(mysqli_affected_rows($conn)>0){
                    echo "<script>event.preventDefault();</script>";
                    $save_msg="Customer Successfully Added!";
                }
            }
           else{
                $save_msg="Do Names really contain Numbers !?? Only Use Alphabets and Space in Name";
           }
        }
    }
?>
<script src="https://cdn.tailwindcss.com"></script>
<title>Vendor View</title>
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
                        <li class="p-2"><a href="Customer.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Customer</a></li>
                        <li class="p-2"><a href="Purchase.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Purchase</a></li>
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
        <!-- here div is for inserting a Customer -->
        <div class=" m-4 text-blue-600 flex flex-col items-center">
           <form class="w-full md:w-[60%] bg-white rounded" method="POST">
                <div class="text-center text-2xl p-4">
                    Customer Details
                </div>
                <div class="p-4 flex flex-col justify-center items-center gap-4">
                    <input type="text" placeholder="Customer Name" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400" name="cname">
                    <input type="text" placeholder="Customer Address" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400" name="cadd">
                    <input type="text" placeholder="Customer Number" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400" name="cphone" pattern="\d{10}" title="Enter 10 digits valid number">
                    <input type="text" placeholder="Customer Email" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400" name=" cemail">
                    <div class="grid grid-cols-2 items-center w-full">
                        <label for="bdate" class="text-left">Birth Date:</label>
                        <input type="date" name="bdate" id="bdate" class="bg-transparent border-b-2 border-blue-600 p-2 w-full  placeholder-blue-400">
                    </div>
                    <div class="flex flex-row justify-center gap-4 w-full">
                        <button type="submit" name="addCustomer" class="p-2 bg-blue-600 rounded text-white w-[45%] hover:bg-green-600">Save</button>
                        <a href="viewCustomers.php" target="_blank" class="w-[45%]"><button type="button" class="p-2 bg-blue-600 rounded text-white hover:bg-[#B721FF] w-full">View All</button></a>
                    </div>
                </div> 
           </form> 
           <span class="text-blue-600 rounded bg-white p-3 text-xl">
                <?php echo"$save_msg" ?>
           </span>
        </div>

    </div>
</body>