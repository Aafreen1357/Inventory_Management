<?php 
    include("common/db_connection.php");
    echo "<script>event.preventDefault();</script>";
    ini_set('display_errors', 0);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete'])) {
            $category_id = $_POST['category_id'];
            $delete_query = "DELETE FROM categories WHERE category_id = '$category_id'";
            if (mysqli_query($conn, $delete_query)) {
                echo "<script>event.preventDefault();</script>";
            } else {
                echo "Error deleting category: " . mysqli_error($conn);
            }
        } else {
            $category_id = $_POST['category_id'];
            $status = $_POST['status'];
            $update_query = "UPDATE categories SET status = '$status' WHERE category_id = '$category_id'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>event.preventDefault();</script>";
            } else {
                echo "Error updating status: " . mysqli_error($conn);
            }
        }
    }
    if(isset($_POST["yesAgain"]))
    {
        $delete_query = "TRUNCATE TABLE categories";
        $result = mysqli_query($conn, $delete_query);
        if($result)
        {
            echo "<script>event.preventDefault();</script>";
        }
    }
    if(isset($_POST["searchCategory"]))
    {
        $category = $_POST["categoryAdd"];
        $category = mysqli_real_escape_string($conn, $category);
        $search_query = "SELECT * FROM categories WHERE c_name = '$category'";
        $result = mysqli_query($conn, $search_query);
        if(mysqli_num_rows($result) > 0)
        {
            $duplicateFetched = true; // Set a flag
        }
        else{
            $insert_query = "INSERT INTO categories (c_name) VALUES ('$category')";
            $result = mysqli_query($conn, $insert_query);
            if($result)
            {
                $dataFetched = true; // Set a flag
            }
            else{
                $dataFetched = false; // Set a flag
            }
        }   
    }
    else
    {
        echo "<script>document.querySelector('.hidden').style.display = 'none';</script>";
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
                        <li class="p-2"><a href="products.php" class=" w-full border-b-2 border-blue-600 md:border-0 p-2 rounded hover:text-black hover:bg-white hover:bg-opacity-50">Customer</a></li>
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
        <!-- Add Category -->
        <div class=" flex flex-col justify-center items-center gap-4 p-4">
            <!-- Add Category Box -->
            <div class="flex flex-col justify-center border border-white bg-white rounded  gap-2 p-4 w-[80%] md:w-[40%]">
                <form action="" method="post">
                    <h2 class="text-xl font-bold text-blue-600 mb-2">Add Category</h2>
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" name="categoryAdd" id="category" class="p-2 w-[70%] rounded border border-blue-600" placeholder="Enter Category">
                        <button type="submit" class="bg-blue-600 text-white text-lg rounded p-2 hover:bg-black hover:shadow hover:text-white hover:scale-x-105 transition-duration-300" name="searchCategory" onclick="addCategory();">Add</button>
                    </div>
                </form>
            </div>
            <!-- Success Message -->
            <div class="border border-white flex flex-col items-center justify-center gap-2 p-4 w-[80%] md:w-[40%]" id="success" style="display: <?php echo isset($duplicateFetched) && $duplicateFetched ? 'block' : 'none'; ?>;">
                <?php if(isset($duplicateFetched) && $duplicateFetched): ?>
                    Category already exists! Category ID: <?php echo $row['category_id']; ?>
                    
                <?php endif; ?>
        </div>
        </div>
        <!-- Hide table and delete all options here -->
        <div class="flex flex-col md:flex-row gap-2 justify-center p-4">
                <input type="button" class="bg-white text-blue-600 hover:bg-green-600 hover:text-white p-2 rounded" id="toggleView" onclick="displayTable();" value="Hide Table"></input>
                <input type="button" class="bg-white text-blue-600 hover:bg-red-600 hover:text-white p-2 rounded" name="delAll" id="delAllButton" onclick="askForDel();" value="Delete All"/>
        </div>
        <!-- Ask for delete all categories -->
        <div class="flex flex-col md:flex-row gap-2 justify-center p-4 text-white items-center hidden w-[90%] m-4 " id="askForDelete">
                Really want to delete all categories?
                <form action="" method="post">
                    <input type="submit" class="bg-white text-blue-600 hover:bg-red-600 hover:text-white p-2 rounded" name="yesAgain" id="yesAgin" value="Yes"/>
                </form>
        </div>
        <!-- Table View -->
        <div class=" p-4 flex justify-center" id="tableView">
            <table class="border border-white text-white w-[90%] md:w-[70%]">
                <thead class="border border-white p-2">
                    <tr class="border border-white">
                        <th class="border border-white p-2">Category ID</th>
                        <th class="border border-white p-2">Category Name</th>
                        <th class="border border-white p-2">Is Active?</th>
                        <th class="border border-white p-2">Update</th>
                        <th class="border border-white p-2">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $select_query = "SELECT * FROM categories";
                        $result = mysqli_query($conn, $select_query);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo "<td class='text-center border border-white'>".$row['category_id']."</td>";
                                echo "<td class='text-center border border-white'>".$row['c_name']."</td>";
                                echo "<td class='border border-white text-center flex justify-center items-center'>";
                                if ($row['status'] === '1') {
                                    echo "<form method='POST' action=''>";
                                    echo "<input type='hidden' name='category_id' value='".$row['category_id']."'>";
                                    echo "<input type='hidden' name='status' value='0'>";
                                    echo "<button type='submit' name='active' id='active'><img src='images/active.png' style='width: 50px; height: 50px;' alt='Active'></button>";
                                echo "</form>";
                                } else {
                                    echo "<form method='POST' action=''>";
                                    echo "<input type='hidden' name='category_id' value='".$row['category_id']."'>";
                                    echo "<input type='hidden' name='status' value='1'>";
                                    echo "<button type='submit' name='inActive' id='inActive'><img src='images/inactive.png' style='width: 50px; height: 50px;' alt='Inactive'></button>";
                                    echo "</form>";
                                }
                                echo "</td>";   
                                echo "<td class='text-center border border-white p-2'><input type='submit' value='Update' class='bg-green-500 rounded p-2 text-white hover:bg-green-800'/></td>";
                                echo "<td class='text-center border border-white p-2'>";
                                echo "<form method='POST' action=''>";
                                echo "<input type='hidden' name='category_id' value='".$row['category_id']."'>";
                                echo "<button type='submit' name='delete' class='bg-red-500 rounded p-2 text-white hover:bg-red-800'>Remove</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
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
    function displayTable()
    {
        const tableView=document.getElementById("tableView");
        const toggleView=document.getElementById("toggleView");
        if(tableView.style.display=="none"){
            tableView.style.display="block";
            toggleView.value="Hide Table";
        }
        else{
            tableView.style.display="none";
            toggleView.value="See All"
        }
    }
    function askForDel()
    {
        const askForDelete=document.getElementById("askForDelete");
        const delAllButton=document.getElementById("delAllButton");
        if(askForDelete.style.display=="none"){
            askForDelete.style.display="block";
            delAllButton.value="Cancel";
        }
        else{
            askForDelete.style.display="none";
            delAllButton.value="Delete All";
        }
    }
    function setActive()
    {
        var active = document.getElementById("active");
        active.src = "images/active.png";
    }
    function setInActive()
    {
        var inActive = document.getElementById("inActive");
        inActive.src = "images/inactive.png";
    }
</script>