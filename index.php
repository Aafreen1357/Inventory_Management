<?php
    include("common/db_connection.php");
    // echo "<script>event.preventDefault();</script>";
    ini_set('display_errors', 0);
    // Following code is to avoid login again and agian and I think I don't need this code.
    // if($_SESSION['user_name'] !='')
    // {
    //     header("Location: home.php");
    // }
    // else
    // {
    //     header("Location: index.php");
    // }

    if(isset($_POST['login']))
    {
        // echo "<script>alert('Login Successful');</script>";
        $username=trim($_POST['user_name']);
        $password=trim( $_POST['user_pass']);  
        session_start();
        $_SESSION['user_name'] = $username;
        $select_query= 'SELECT * FROM user_details WHERE user_name="'.$username.'" AND user_pass="'.$password.'"';
        $result=mysqli_query($conn,$select_query);
        $login_msg=' ';
        if(mysqli_num_rows($result)> 0)
        {
            $login_msg="Login Successful";
            header("Location: home.php");
        }
        else{
            $login_msg= "Wrong username or password";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
    <script src="scripts.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body >
    <div>
        <nav class="p-4 mb-4 flex"><button type="submit" class="bg-blue-500 text-white text-lg rounded p-2 hover:bg-white hover:shadow hover:text-blue-500 hover:scale-x-105 transition-duration-300"><a href="register.php">Sign up</a></button></nav>
    </div>
    <div class="flex flex-col items-center h-full w-full justify-center gap-4 p-4">
        <div>
            <h1 class="text-4xl font-bold text-center text-white p-4 hover:text-blue-600 hover:scale-x-105 transition duration-300">Inventory Management System</h1>
        
        </div>
        <form method="post" class="w-[80%] md:w-[40%]">
            <div class="bg-white shadow-md rounded px-4 pt-6 pb-8 m-4 flex justify-center flex-col items-center w-full gap-4">
                <h2 class="center text-2xl text-blue-400 font-bold hover:text-blue-600">Login Details</h2>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td><label for="userName" class="text-base">User Name:</label></td>
                            <td class="w-[60%]"><input type="text" name="user_name" id="userName" class="border border-gray-400 rounded m-2 p-2 w-full" value="<?php echo $username; ?>" required></td>
                            <!-- <td><?php echo $error; ?></td> -->
                        </tr>
                        <tr>
                            <td><label for="userPass" class="text-base">Password:</label></td>
                            <td class="w-[70%]"><input type="password" name="user_pass" id="userPass" class="border border-gray-400 rounded m-2 p-2 w-full"  value="<?php echo $password; ?>" required></td>
                            <td ><button type="button" onclick="togglePass()"><img src="images/visibility_on.png" alt="visible" height="10px" width="30px" class="m-2" id="visibileimg"></button></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Login" class="bg-blue-400 p-2 mt-4 rounded text-white hover:bg-blue-600 hover:scale-x-105 w-full" name="login"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-red-500"><?php echo $login_msg; ?></td>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

</body>
</html>