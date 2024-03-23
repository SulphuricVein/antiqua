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
    
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-[#111827] text-white">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<div class="container min-w-[100vw]">
    

<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Antiqua</span>
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="tel:5541251234" class="text-sm  text-gray-500 dark:text-white hover:underline">Admin Dashboard</a>
            <a href="#" class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Logout</a>
        </div>
    </div>
</nav>
<nav class="bg-gray-50 dark:bg-gray-700 w-full">
    <div class="max-w-screen-xl w-full px-4 py-3 mx-auto">
        <div class="flex items-center">
            <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                <li>
                    <a href="insert_products.php" class="text-gray-900 dark:text-white hover:underline" aria-current="page">Insert Products</a>
                </li>
                <li>
                    <a href="index.php?view_products" class="text-gray-900 dark:text-white hover:underline">View Products</a>
                </li>
                
                <li>
                    <a href="index.php?add_category" class="text-gray-900 dark:text-white hover:underline">Add Category</a>
                </li>
                <li>
                    <a href="index.php?view_category" class="text-gray-900 dark:text-white hover:underline">View categories</a>
                </li>
                <li>
                    <a href="index.php?add_brand" class="text-gray-900 dark:text-white hover:underline">Add brand</a>
                </li>
                <li>
                    <a href="index.php?view_brands" class="text-gray-900 dark:text-white hover:underline">View brands</a>
                </li>
                <li>
                    <a href="index.php?view_orders" class="text-gray-900 dark:text-white hover:underline">Orders</a>
                </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white hover:underline">Payments</a>
                </li>
                <li>
                    <a href="index.php?view_users" class="text-gray-900 dark:text-white hover:underline">Users</a>
                </li>
            </ul>
        </div>
    </div>
</nav>






</div>
<div class="container min-w-[100vw]">
    <?php
    if(isset($_GET["add_category"])){
        include("add_category.php");
    }
    else if(isset($_GET["add_brand"])){
        include("add_brand.php");
    }
    else if(isset($_GET["view_orders"])){
        echo "<script>window.open('view_orders.php','_self')</script>";
    }
    else if(isset($_GET["view_category"])){
        echo "<script>window.open('view_category.php','_self')</script>";
    }
    else if(isset($_GET["view_brands"])){
        echo "<script>window.open('view_brands.php','_self')</script>";
    }
    else if(isset($_GET["view_products"])){
        echo "<script>window.open('view_products.php','_self')</script>";
    }
    else if(isset($_GET["view_users"])){
        echo "<script>window.open('view_users.php','_self')</script>";
    }
    
    ?>

</div>
</body>
</html>