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
     $query="select * from orders";
     $res_cart=mysqli_query($conn,$query);
     if(mysqli_num_rows($res_cart)>0){

     
    ?>
    </div>
    <div class="first-child w-[80%] m-auto mt-10">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">
                    Product name
                </th>
                <th scope="col" class="px-4 py-4">
                    Product Image
                </th>
                
                <th scope="col" class="px-6 py-4">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit
                </th>
               
            </tr>
        </thead>
        <tbody>
            <?php
            
            $query="select * from orders";
            $res_cart=mysqli_query($conn,$query);
            if (!$res_cart) {
                die("Error in cart query: " . mysqli_error($conn));
            }
            
            while($row=mysqli_fetch_assoc($res_cart)){
                $id=$row['product_id'];
                $ip=$row['ip'];
                $name=$row['name'];
                $address=$row['address'];   
                $new_query="select * from products where product_id=$id";
                $res_product=mysqli_query($conn,$new_query);
                while($xrow=mysqli_fetch_assoc($res_product)){
                    $product_title=$xrow['product_title'];
                    $product_price=$xrow['product_price'];
                    $product_brand=$xrow['brand_id'];
                    $product_category=$xrow['category_id'];
                    $product_image=$xrow['primary_image'];
                    $cat_query="select * from categories where category_id=$product_category";
                    $cat_process=mysqli_query($conn,$cat_query);
                    $cat_res=mysqli_fetch_assoc($cat_process);
                    // $category=$cat_res['category_title'];

                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                        $product_title
                    </th>
                    <td class='px-6 py-4'>
                        <img class='w-16 h-16 object-cover' src='./product_images/$product_image'>
                    </td>
                    
                    <td class='px-6  py-4'>
                        $$product_price
                    </td>
                    <td class='px-6  py-4'>
                        $name
                    </td>
                    <td class='px-6  py-4'>
                        $address
                    </td>
                    <td class='px-0 py-4'>
                    <a href='view_orders.php?id=$id&ip=$ip' type='button' name='remove-btn' class='focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800'>Mark Delivered</button>
                    </a>
                </tr>";   
                
                    
                }
            }
           
if(isset($_GET['id'])){
    
    $id=$_GET['id'];
    $delete_query="delete  from orders where product_id=$id and ip=$ip ";
    $delete_product=mysqli_query($conn,$delete_query); 
    if($delete_product){
        echo "<script>alert('Item deleted succesfully')</script>";
        echo "<script>window.open('view_orders.php','_self')</script>";
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


