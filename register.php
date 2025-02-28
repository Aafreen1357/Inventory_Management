<?php
        include("common/db_connection.php");
        echo "<script>event.preventDefault();</script>";
        ini_set('display_errors', 0);

        if(isset($_POST["sign_up"]))
        {
                $user_full_name=trim($_POST['user_full_name']);
                $user_name=trim($_POST['user_name']);
                $user_pass=trim($_POST['user_pass']);
                $con_user_pass=trim($_POST['con_user_pass']);
                $user_email=trim($_POST['user_email']);
                $user_phone=trim($_POST['user_phone']);
                $country_code = $_POST['country_code'];
                if($user_pass==$con_user_pass)
                {
                        $sql="INSERT INTO user_details (user_full_name, user_name, user_pass, user_email, user_phone,country_code) VALUES ('$user_full_name', '$user_name', '$user_pass', '$user_email', '$user_phone','$country_code')";
                        if($conn->query($sql) === TRUE)
                        {
                                echo "<script>alert('User Registration S');</script>";
                                echo "<script>document.getElementById('show_status').style.display='block';</script>";
                        }
                        else
                        {
                                echo "<script>alert('User Registration Failed');</script>";
                        }
                }
                else if(!preg_match('/^[0-9]*$/',$user_phone))
                {
                        echo '<script>alert("Invalid Phone Number");</script>';
                }
                else
                {
                        echo "<script>document.getElementById('show_status').style.display='block';</script>";
                }
        }
?>
<link rel="stylesheet" href="styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="scripts.js"></script>
<nav class="p-4 mb-4 flex">
        <button type="submit" class="bg-blue-500 text-white text-lg rounded p-2 hover:bg-white hover:shadow hover:text-blue-500 hover:scale-x-105 transition-duration-300"><a href="index.php">Go Back</a></button>
</nav>
<div class="flex flex-col items-center justify-center p-2 gap-2">
        <div>
                <h1 class="text-4xl font-bold text-center text-white p-4 hover:text-blue-600 hover:scale-x-105 transition duration-300">Sign Up</h1>
        </div>
                <div class="p-4 md:w-[40%] w-[80%] bg-white hover:shadow-right hover:shadow-md hover:shadow-white rounded">
                        <form action="" method="post">
                                <table class="p-4 w-full">
                                        <tbody>
                                                <tr>
                                                        <td><label for="userFullName" class="text-base">Full Name:</label></td>
                                                        <td class="w-[60%]"><input type="text" name="user_full_name" id="userFullName" class="border border-gray-400 rounded m-2 p-2 w-full" placeholder="First Name Last Name" required></td>
                                                </tr>
                                                <tr>
                                                        <td><label for="userName" class="text-base">User Name:</label></td>
                                                        <td><input type="text" name="user_name" id="userName" class="border border-gray-400 rounded m-2 p-2 w-full" required></td>
                                                </tr>
                                                <tr>
                                                        <td><label for="userPass" class="text-base">Password:</label></td>
                                                        <td class="w-[70%]"><input type="password" name="user_pass" id="userPass" class="border border-gray-400 rounded m-2 p-2 w-full" pattern=".{8,}" title="Password should be at least 8 characters long"  required></td>
                                                        <td ><button type="button" onclick="togglePass()"><img src="images/visibility_on.png" alt="visible" height="10px" width="30px" class="m-2" id="visibileimg"></button></td>
                                                </tr>
                                                <tr>
                                                        <td><label for="conUserPass" class="text-base">Confirm Password:</label></td>
                                                        <td class="w-[70%]"><input type="password" name="con_user_pass" id="conUserPass" class="border border-gray-400 rounded m-2 p-2 w-full" pattern=".{8,}" title="Password should be at least 8 characters long" required></td>
                                                        <td ><button type="button" onclick="conTogglePass()"><img src="images/visibility_on.png" alt="visible" height="10px" width="30px" class="m-2" id="conVisibileimg"></button></td>
                                                </tr>
                                                <tr>
                                                        <td><label for="userEmail" class="text-base">Email:</label></td>
                                                        <td><input type="email" name="user_email" id="userEmail" class="border border-gray-400 rounded m-2 p-2 w-full" required></td>
                                                </tr>
                                                <tr>
                                                        <td><label for="userPhone" class="text-base">Phone:</label></td>
                                                        <td>  <select name="country_code" id="countryCode" class="border border-gray-400 rounded m-2 p-2 w-[21%]" required>
                                                                <option value="+91">+91 (India)</option>
                                                                <option value="+1">+1 (USA)</option>
                                                                <option value="+44">+44 (UK)</option>
                                                                <option value="+91">+92 (Pakistan)</option>
                                                                </select>
                                                                
                                                        <input type="text" name="user_phone" id="userPhone" class="border border-gray-400 rounded m-2 p-2 w-[70%]" pattern="\d{10}" title="Phone number should be 10 digits" required></td>
                                               
                                                </tr>
                                                <tr>
                                                        <td colspan="2"><input type="submit" value="Sign up" name="sign_up" class="bg-blue-400 p-2 mt-4 rounded text-white hover:bg-blue-600 hover:scale-x-105 w-full" onclick="checkOptions()"></td>
                                                </tr>
                                                <tr>
                                                        <td colspan="2"><pre class="text-red-400 hover:text-red-600">Already have an account?<a href="index.php" class="underline">Login</a></pre>
                                                </tr>
                                        </tbody>
                                </table>
                        </form>
                </div>
                <p><php echo $pass_error; ?></php></p>
        <div id="show_status" class="hidden">
                
                <p class="text-center text-red-600 font-bold" >Congratulations! User Registered</p>
        </div>  
</div>
<script>
        function checkOptions()
        {
                var userFullName=document.getElementById("userFullName").value;
                var userName=document.getElementById("userName").value;
                var userPass=document.getElementById("userPass").value;
                var conUserPass=document.getElementById("conUserPass").value;
                var userEmail=document.getElementById("userEmail").value;
                var userPhone=document.getElementById("userPhone").value;
                const show_status=document.getElementById("show_status");
                if(userFullName=="" || userName=="" || userPass=="" || conUserPass=="" || userEmail=="" || userPhone=="")
                {
                        show_status.innerHTML="Please fill all the fields";
                        show_status.style.text='Red';
                        show_status.style.fontWeight='bold';
                        show_status.style.display="block";
                }
               else if(userPass!=conUserPass)
                {
                        show_status.innerHTML="Passwords do not match";
                        show_status.style.text='Red';
                        show_status.style.fontWeight='bold';
                        show_status.style.display="block";
                }
                else if(length(userPass<8)){
                        show_status.innerHTML="Password should be at least 8 characters long";
                        show_status.style.text='Red';
                        show_status.style.fontWeight='bold';
                        show_status.style.display="block";
                }
                else if(!userPhone.match(/^\d{10}$/)){
                        show_status.innerHTML="Phone number should be 10 digits";
                        show_status.style.text='Red';
                        show_status.style.fontWeight='bold';
                        show_status.style.display="block";
                }
                else if(!userEmail.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)){
                        show_status.innerHTML="Invalid Email";
                        show_status.style.text='Red';
                        show_status.style.fontWeight='bold';
                        show_status.style.display="block";
                }
                else if(!userName.match(/^[a-zA-Z]*$/)){
                        show_status.innerHTML="It should only contain alphabets";
                        show_status.style.text='Red';
                        show_status.style.fontWeight='bold';
                        show_status.style.display="block";
                }
                else if(userPass==conUserPass){
                        show_status.style.color='Green';
                        show_status.innerHTML="Congratulations! User Registered";
                        show_status.style.text='Green';
                        show_status.style.fontWeight='bold';
                        show_status.style.display="block";
                }

        }
        function userNameAlert()
        {
                show_status.innerHTML="It should only contain alphabets";
                show_status.style.text='Red';
                show_status.style.fontWeight='bold';
                show_status.style.display="block";
        }
</script>