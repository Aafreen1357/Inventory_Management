<?php
    // Database connection
    include("common/db_connection.php");
    echo "<script>event.preventDefault();</script>";
    ini_set('display_errors', 0);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete'])) {
            $sub_category_id = $_POST['sub_category_id'];
            $category_id = $_POST['selecteddCategory'];
            $delete_query = "DELETE FROM sub_categories WHERE sub_category_id = '$sub_category_id' and category_id = '$category_id'";
            if (mysqli_query($conn, $delete_query)) {
                echo "<script>event.preventDefault();</script>";
            } else {
                echo "Error deleting category: " . mysqli_error($conn);
            }
        } else {
            $sub_category_id = $_POST['sub_category_id'];
            $status = $_POST['status'];
            $update_query = "UPDATE sub_categories SET status = '$status' WHERE sub_category_id = '$sub_category_id'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>event.preventDefault();</script>";
            } else {
                echo "Error updating status: " . mysqli_error($conn);
            }
        }
    }

// Adding subcategory code    
if (isset($_POST['addSubCategory'])) {
    if (!empty($_POST['selecteddCategory'])) {
        $category_id = $_POST['selecteddCategory'];
        $subCategory = $_POST['subCategory'];
        $sdescription = $_POST['sdescription'];

        // Check if sub-category already exists
        $select_query = "SELECT * FROM sub_categories WHERE sc_name='$subCategory' and category_id='$category_id'";
        $result = mysqli_query($conn, $select_query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Sub-Category already exists');</script>";
        } else {
            // Insert new sub-category
            $sql = "INSERT INTO sub_categories (category_id, sc_name, sc_description) 
                    VALUES ('$category_id', '$subCategory', '$sdescription')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('New record created successfully');</script>";
            } else {
                echo "<script>alert('Failed to save: " . mysqli_error($conn) . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Please select a category');</script>";
    }
}

?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sub-Category</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styleHome.css">
<script src="https://cdn.tailwindcss.com"></script> 
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
        <!-- here is the code for selecting the category -->
        <form action="" method="post" class="gap-3">
            <!-- <div> -->
                    <!-- select category label here -->
                    <label for="selecteddCategory" class="text-white text-lg p-2">Select Category:</label>
                    <!-- select category dropdown here -->
                    <select name="selecteddCategory" id="selecteddCategory" class="w-1/4 p-2 rounded-lg">
                    <?php $sql_select_query = "SELECT category_id, c_name FROM categories";
                    $cresult=mysqli_query($conn,$sql_select_query) ?>
                        <?php
                            while ($row = $cresult->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['category_id']) . "'>" . htmlspecialchars($row['c_name']) . "</option>";
                            } ?>
                    </select>
                    <!-- add sub-category button here but it's useless -->
                    <!-- <button type="submit" class="bg-white text-blue-600 p-2 rounded-lg" name="addSubCategory">Add Sub-Category</button>
                </form> -->
            <!-- </div> -->
            <!-- Adding Sub-Category -->
            <!-- <div > -->
                <!-- <form action="" method="post"> -->
                    <div class="grid grid-cols-[1fr,3fr] gap-2 p-4 m-2 bg-white bg-opacity-90 rounded-lg">
                        <label for="subCategory" class="text-blue-600 text-lg p-2 ">Sub-Category:</label>
                        <input type="text" name="subCategory" id="subCategory" class="w-[90%] md:w-[50%] p-2 rounded-lg border border-blue-600 focus:border-2 focus:border-blue-600">
                        <label for="description" class="text-blue-600 text-lg p-2">Description:</label>
                        <input type="text" name="sdescription" id="sdescription" class="w-[90%] p-2 rounded-lg border border-blue-600">
                        <input type="submit" class="bg-blue-600 text-white p-2 rounded-lg w-full m-2" name="addSubCategory" id="addSubCategory"  onclick="addSubCategory();" value="Add Sub-Category"/>
                    </div>
            <!-- </div>      -->
        </form>
        <!-- Table View -->
        <div class=" p-4 flex justify-center" id="tableView">
            <table class="border border-white text-white w-[90%] md:w-[70%]">
                <thead class="border border-white p-2">
                    <tr class="border border-white">
                        <th class="border border-white p-2">Sub-Category Name</th>
                        <th class="border border-white p-2">Category Name</th>
                        <th class="border border-white p-2">Is Active?</th>
                        <th class="border border-white p-2">Update</th>
                        <th class="border border-white p-2">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $select_join_query = "SELECT sc.sub_category_id, sc.sc_name, sc.sc_description, c.c_name AS category, sc.status FROM sub_categories sc JOIN categories c ON sc.category_id = c.category_id";
                        $result = mysqli_query($conn, $select_join_query);
                        if(mysqli_num_rows($result) > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo "<td class='text-center border border-white'>".$row['sc_name']."</td>";
                                
                                echo "<td class='text-center border border-white p-2'>".$row['category']."</td>";
                                echo "<td class='border border-white text-center flex justify-center items-center'>";
                                if ($row['status'] === '1') {
                                    echo "<form method='POST' action=''>";
                                    echo "<input type='hidden' name='sub_category_id' value='".$row['sub_category_id']."'>";
                                    echo "<input type='hidden' name='status' value='0'>";
                                    echo "<button type='submit' name='active' id='active'><img src='images/active.png' style='width: 50px; height: 50px;' alt='Active'></button>";
                                echo "</form>";
                                } else {
                                    echo "<form method='POST' action=''>";
                                    echo "<input type='hidden' name='sub_category_id' value='".$row['sub_category_id']."'>";
                                    echo "<input type='hidden' name='status' value='1'>";
                                    echo "<button type='submit' name='inActive' id='inActive'><img src='images/inactive.png' style='width: 50px; height: 50px;' alt='Inactive'></button>";
                                    echo "</form>";
                                }
                                echo "</td>";   
                                echo "<td class='text-center border border-white p-2'>";
                                echo "<form method='POST' action='update_category.php'>";
                                echo "<input type='hidden' name='sub_category_id' value='".$row['sub_category_id']."'>";
                                echo "<input type='submit' value='Update' class='bg-green-500 rounded p-2 text-white hover:bg-green-800'/>";
                                echo "</form>";
                                echo "</td>";
                                echo "<td class='text-center border border-white p-2'>";
                                echo "<form method='POST' action=''>";
                                echo "<input type='hidden' name='sub_category_id' value='".$row['sub_category_id']."'>";
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

<?php
$conn->close();
?>