<?php

include("../db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<div class="container   dark min-w-[100vw]">

    <div class="nav">
    <?php
        include("anavbar.php");
    ?>
    <?php
     $query="select * from users";
     $res_cart=mysqli_query($conn,$query);
     if(mysqli_num_rows($res_cart)>0){

     
    ?>
    </div>
    <div class="first-child w-[80%] m-auto mt-10">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">
                     ID
                </th>
                <th scope="col" class="px-6 py-4">
                    First Name
                </th>
                <th scope="col" class="px-6 py-4">
                    Last Name
                </th>
                <th scope="col" class="px-4 py-3">
                     Username
                </th>
                <th scope="col" class="px-4 py-4">
                     Password
                </th>
                <th scope="col" class="px-4 py-4">
                    Reg Date
                </th>
                <th scope="col" class="px-6 py-4">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit
                </th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            
            $query="select * from users";
            $res_cart=mysqli_query($conn,$query);
            if (!$res_cart) {
                die("Error in cart query: " . mysqli_error($conn));
            }
            
            while($row=mysqli_fetch_assoc($res_cart)){
                $id=$row['id'];
                $username=$row['username'];
                $password=$row['password'];
                $reg=$row['reg'];
                $fname=$row['fname'];
                $lname=$row['lname'];
                $phone=$row['phone'];
                
                
                   echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                   <td class='px-6  py-4'>
                        $id
                    </td>
                    <td class='px-6  py-4'>
                    $fname
                    </td>
                    <td class='px-6  py-4'>
                    $lname
                    </td>
                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                    $username
                    </th>
                    <td class='px-6  py-4'>
                        $password
                    </td>
                    <td class='px-6  py-4'>
                        $reg
                    </td>
                    <td class='px-6  py-4'>
                        $phone
                    </td>
                   
                    <td class='px-0 py-4'>
                <a href='view_users.php?id=$id' type='button' name='remove-btn' class='focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'>Ban User</button>
                </a>
            </td>
                </tr>";   
                
                    
                
            }
           
if(isset($_GET['id'])){
    
    $id=$_GET['id'];
    $delete_query="delete  from users where id=$id";
    $delete_product=mysqli_query($conn,$delete_query); 
    if($delete_product){
        echo "<script>alert('Item deleted succesfully')</script>";
        echo "<script>window.open('view_users.php','_self')</script>";
    }
    
}


            ?>
            <?php
     }
     else{
        include("../404.php");
     }
            ?>
              </tbody>
    </table>
    </div>




</div>
</body>
</html>


