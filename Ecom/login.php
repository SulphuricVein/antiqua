<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
  include('db.php');
  include('common_function.php');
  if(isset($_POST['submit-btn'])){
    $username=$_POST['username'];
   
    $password=$_POST['password'];
    
  $query="select * from users where username='$username'  and password='$password' ";
  $res=mysqli_query($conn,$query);
  
  if(mysqli_num_rows($res)>0){
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
   
    // Header('Location:index.php');
    echo "<script>alert('Logged in successfully')</script>";
    echo "<script>window.open('index.php','_self')</script>";
    }
    else{
      echo "<script>alert('Invalid Credentials')</script>";
    }
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="dark bg-[#111827]">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<div class="container dark min-w-[100vw]">
<nav class="dark">
        <?php
        include('navbar.php');
        ?>
        
      </nav>

<h1 class="text-2xl text-white text-center mb-7 mt-10">Please Login</h1>


<form class="max-w-sm h-[60vh] mx-auto" method="post" action="login.php">
  <div class="mb-5">
    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
    <input type="username" id="username" name="username" class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="akash@gmail.com" required>
  </div>
  <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium  dark:text-white">Your password</label>
    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
  </div>
  <div class="flex items-start mb-5  flex-col ">
    <div class="flex items-center h-6 w-full ">
      <!-- <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
    </div>
    <label for="remember" class="ms-2 text-sm font-medium  dark:text-white">Remember me</label> -->
    <p class='text-sm text-white '>Dont have an account?<a href="signup.php" class=' text-sm  text-blue-500 dark:text-blue-500 hover:underline '> Sign up</a> </p> 
  </div>
  
  <button type="submit" name="submit-btn" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>


</div>
<footer class="dark">
<?php
include('footer.php');
?>
</footer>
</body>
</html>