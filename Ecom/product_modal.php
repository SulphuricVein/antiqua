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
    if(isset($_GET['id'])){
        $value=$_GET['id'];
        $query="select * from products where product_id=$value";
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

    <!-- <header>
      <h2 class="text-xl font-bold  sm:text-3xl">Product Collection</h2>
    </header> -->
    <!-- <ul class="mt-8 grid gap-4 sm:grid-cols-1 lg:grid-cols-3 h-[70vh]"> -->
      <?php
        if(isset($_GET['id'])){
            $value=$_GET['id'];
        
    $query="select * from products where product_id=$value";
       $res=mysqli_query($conn,$query); 
      
       while($row=mysqli_fetch_assoc($res)){
        $product_id=$row['product_id'];
         $product_title=$row['product_title'];
         $product_description=$row['product_description'];
         $product_price=$row['product_price'];
         $primary_image=$row['primary_image'];
         $secondary_image=$row['secondary_image'];
         $backdrop_image=$row['backdrop_image'];
    //      echo "<li>
    //      <a href='#' class='group block overflow-hidden'>
    //          <img
    //              src='./admin/product_images/$product_image'
    //              alt=''
    //              class='h-[350px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[450px]'
    //          />
     
    //          <div class='relative pt-3'>
    //              <h3 class='text-xs group-hover:underline group-hover:underline-offset-4'>
    //                  $product_title
    //              </h3>
     
    //              <p class='mt-2'>
    //                  <span class='sr-only'> Regular Price </span>
     
    //                  <span class='tracking-wider'> £$product_price GBP </span>
    //              </p>
    //              <div class='buttons mt-3'>
    //                  <button type='button'
    //                      class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>
    //                      Add to cart
    //                  </button>
    //                  <button type='button'
    //                      class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>
    //                      View more
    //                  </button>
    //              </div>
    //          </div>
    //      </a>
    //  </li>
    //  ";
    echo "
    <div class='w-full   flex flex-row gap-10'>
    <div id='default-carousel' class='relative w-full' data-carousel='slide'>
    <!-- Carousel wrapper -->
    <div class='relative  overflow-hidden rounded-lg md:h-[50vh] h-[50vh]'>
         <!-- Item 1 -->
        <div class='hidden duration-700 ease-in-out' data-carousel-item>
            <img src='./admin/product_images/$primary_image' class='absolute block w-[250px] h-[350px] -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2' alt='...'>
        </div>
        <!-- Item 2 -->
        <div class='hidden duration-700 ease-in-out' data-carousel-item>
            <img src='./admin/product_images/$secondary_image' class='absolute block w-[250px] h-[350px] -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2' alt='...'>
        </div>
        
        <div class='hidden duration-700 ease-in-out' data-carousel-item>
            <img src='./admin/product_images/$backdrop_image' class='absolute block w-[250px] h-[350px] -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2' alt='...'>
        </div>
       
    </div>
   
    <div class='absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse'>
        <button type='button' class='w-3 h-3 rounded-full' aria-current='true' aria-label='Slide 1' data-carousel-slide-to='0'></button>
        <button type='button' class='w-3 h-3 rounded-full' aria-current='false' aria-label='Slide 2' data-carousel-slide-to='1'></button>
        <button type='button' class='w-3 h-3 rounded-full' aria-current='false' aria-label='Slide 3' data-carousel-slide-to='2'></button>
       
    </div>
    
    <button type='button' class='absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none' data-carousel-prev>
        <span class='inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none'>
            <svg class='w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 6 10'>
                <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 1 1 5l4 4'/>
            </svg>
            <span class='sr-only'>Previous</span>
        </span>
    </button>
    <button type='button' class='absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none' data-carousel-next>
        <span class='inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none'>
            <svg class='w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 6 10'>
                <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 9 4-4-4-4'/>
            </svg>
            <span class='sr-only'>Next</span>
        </span>
    </button>
</div>
<div class='w-[100rem]'>
<h2 class='text-4xl    mt-4 font-semibold'>$product_title</h2>
<p class='mb-3 text-white mt-10 text-lg'>Description: $product_description </p>
<p class='mb-3 text-white mt-2 text-lg'>Product Price: $$product_price </p>
<a href='index.php?add_to_cart=$product_id'
                         class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>
                         Add to cart
                     </a>
<a href='index.php'
class='inline text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>
Home
</a>
</div>
</div>
 
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