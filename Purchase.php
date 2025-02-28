<?php
    include('common/db_connection.php');
    
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
        <div class="bg-white rounded p-4 m-4">
            <h1 class="text-2xl text-blue-600 text-center p-4">Purchase Details</h1>
            <form method="POST" class="">
                <div class="grid grid-cols-[1fr,2fr] gap-2 md:grid-cols-[1fr,6fr] items-center text-blue-600 mb-4">                
                    <label for="vname">Vendor Name:</label>
                    <div class="flex flex-col ">
                        <input type="text" name="vname" id="vname" class="border rounded border-blue-600 p-2 w-full md:w-[60%]"  placeholder="Vendor Name" oninput="fetchVendorNames()"/>
                        <select class="border rounded border-blue-600 p-2 md:w-[60%] hidden" name="vendorSelect" id="vendorSelect">
                            <?php 

                            ?>
                        </select>
                    </div>
                    
                    <label for="vadd">Address:</label>
                    <textarea class="border rounded border-blue-600 p-2 w-full md:w-[60%]" placeholder="Vendor Address" name="vadd" id="vadd"></textarea>

                    <label for="purchaseDate">Date:</label>
                    <input type="date" name="purchaseDate" id="purchaseDate" class="border rounded border-blue-600 p-2 w-full md:w-[60%]"/>

                    <label for="deliveryDate">Delivery Date:</label>
                    <input type="date" name="deliveryDate" id="deliveryDate" class="border rounded border-blue-600 p-2 w-full md:w-[60%]"/>
                </div>
                <table class="border border-blue-400 rounded text-blue-600 w-full">
                    <thead>
                        <tr>
                            <th class="p-4 text-right border-l border-r border-blue-400">Item Name</th>
                            <th class="p-4 text-right border-l border-r border-blue-400">Quantity</th>
                            <th class="p-4 text-right border-l border-r border-blue-400">Rate per Item</th>
                            <th class="p-4 text-right border-l border-r border-blue-400">Total</th>
                        </tr>
                    </thead>
                    <tbody >
                            <tr>
                                <td class="border border-blue-400 p-2">
                                    <input type="text" name="productName" id="productName" placeholder="Type or Click Item name" class="p-2 w-full text-right" oninput="fetchProducts()" />
                                    <select name="ItemsList" id="ItemsList" class="p-2 w-full text-right hidden" name="selectProduct" id="selectProduct">
                                        <?php
                                        
                                        ?>
                                    </select>
                                </td>
                                <td class="border border-blue-400 p-2"><input type="text" name="" id="" value="1" class="p-2 w-full  text-right "></td>
                                <td class="border border-blue-400 p-2"><input type="text" name="" id="" class="p-2 w-full text-right"></td>
                                <td class="border border-blue-400 p-2"><input type="text" name="" id=""  class="p-2 w-full text-right "></td>
                            </tr>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <script>
        function fetchVendorNames() {
            
            var vname = document.getElementById('vname').value;
            var xhr = new XMLHttpRequest();
            var vendorSelect = document.getElementById('vendorSelect');    
            vendorSelect.style.display="block";
            if (vname===""){
                vendorSelect.style.display="none";
            }
            xhr.open('POST', 'fetchVendors.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    
                    vendorSelect.innerHTML = xhr.responseText;
                }
            };
            xhr.send('vname=' + encodeURIComponent(vname));
        }
        function fetchProducts() {

            var productName = document.getElementById('productName').value;
            var xhr = new XMLHttpRequest();
            var selectProduct = document.getElementById('selectProduct');    
            
            selectProduct.style.display="block";
            if (productName===""){
                selectProduct.style.display="none";
            }
            xhr.open('POST', 'fetchProducts.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    
                    selectProduct.innerHTML = xhr.responseText;
                }
            };
            xhr.send('productName=' + encodeURIComponent(productName));
        }
    </script>
</body>