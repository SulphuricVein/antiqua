<?php
include("db.php");

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
<body class="bg-[#111827] ">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<div class="container text-white min-w-[100vw]">

<section>
  <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
    
    <?php
    $is_404 = false;
    if(isset($_GET['search_data'])){
        $value=$_GET['search_data'];
        $query="select * from products where product_keyword like '%$value%'  ";
        $res=mysqli_query($conn,$query);
        $rows=mysqli_num_rows($res);
        if ($rows == 0) {
            $is_404 = true;
        }
    }
    if ($is_404) {
        include("404.php");
        die(); 
    } 
    else{
        ?>

    <header>
      <h2 class="text-xl font-bold  sm:text-3xl">Product Collection</h2>
    </header>
    <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <?php
        if(isset($_GET['search_data_product'])){
            $value=$_GET['search_data'];
        
       $query="select * from products where product_keyword like '%$value%'  ";
       $res=mysqli_query($conn,$query); 
      
       while($row=mysqli_fetch_assoc($res)){
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_id=$row['product_id'];
         $product_price=$row['product_price'];
         $product_image=$row['primary_image'];
         echo "<li>
         <a href='#' class='group block overflow-hidden'>
             <img
                 src='./admin/product_images/$product_image'
                 alt=''
                 class='h-[350px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[450px]'
             />
     
             <div class='relative pt-3'>
                 <h3 class='text-xs group-hover:underline group-hover:underline-offset-4'>
                     $product_title
                 </h3>
     
                 <p class='mt-2'>
                     <span class='sr-only'> Regular Price </span>
     
                     <span class='tracking-wider'> $$product_price  </span>
                 </p>
                 <div class='buttons mt-3'>
                 <a href='index.php?add_to_cart=$product_id'
                 class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>
                 Add to cart
             </a>
             <a href='product_details.php?id=$product_id'
                 class='inline text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>
                 View more
             </a>
                 </div>
             </div>
         </a>
     </li>
     ";
       }
        }
    }
     ?>
      
    </ul>
  </div>
</section>
</div>
</body>
</html>