<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styleHome.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="scripts.js"></script>  
</head>
<body class="bg-gradient-to-tr from-[#21D4FD] to-[#B721FF] h-screen">
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
        <div class="flex flex-row justify-end">
                <?php
                session_start();
                if (isset($_SESSION['user_name'])) {
                    echo "<p class='text-white text-lg p-2 hover:scale-x-105 transition-duration-300'>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</p>";
                } else {
                    echo "<p class='text-white text-lg p-2 hover:scale-x-105 transition-duration-300'>Welcome, Guest!</p>";
                }
                ?>
        </div>
        <main class="p-2">
            <div class=" flex flex-col md:flex-row gap-4 p-4">
                <div class=" p-2 md:w-[50%]" >
                    <img src="images/inventory_management.png" alt="inventory" class="w-auto h-30 md:h-96 rounded-xl">
                </div>
                <div class="bg-white bg-opacity-90 hover:bg-opacity-100 rounded-lg p-3 flex flex-col gap-4 items-center md:w-[45%]">
                    <h1 class="text-4xl text-blue-600 font-bold center">Inventory Management System</h1>
                    <p class="text-blue-500 text-lg text-justify">This is a simple inventory management system that allows you to manage your products and stocks.This project is one of my proudest achievements. I am Afreenneha Shaikh, a passionate and dedicated software developer with a knack for creating efficient and user-friendly applications. With a strong background in web development and a keen eye for detail, I strive to deliver high-quality solutions that meet the needs of my clients. My expertise in various programming languages and frameworks allows me to tackle complex problems with ease. I am always eager to learn new technologies and improve my skills to stay ahead in the ever-evolving tech industry. Thank you for visiting my project, and I hope you find it as exciting as I do! Visit my <a href="https://aafreenshaikh.netlify.app/" target="_blank" class="text-blue-600 underline">Portfolio</a></p>
                </div>
            </div>
           
        </main>
       
    </div>
</body>
</html>
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
</script>