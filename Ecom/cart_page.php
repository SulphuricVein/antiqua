<?php
    include('db.php');
    include('common_function.php');
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        
        
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antiqua</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!-- font awesome -->
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
<body class="bg-[#111827] " >
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <div class="container min-w-[100vw]">
      <nav class="dark">
        <?php
        include('navbar.php');
        ?>
      </nav>
      
      <div class="gallery dark w-[80%] m-auto mt-10">
      <div class="relative overflow-x-auto ">
        <?php
        if(isset($_SESSION['username']))
            
        { 
        ?>
        <?php
         
            $ip=$_SESSION['username'];;
            $query="select * from cart where ip='$ip'";
            $res_cart=mysqli_query($conn,$query);
            if(mysqli_num_rows($res_cart)==0){
                echo "
                <div class='mx-auto max-w-screen-sm text-center mt-4'>
                <h1 class='mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 text-center md:text-5xl lg:text-5   xl dark:text-white'>No items in the cart</h1>
                <p class='mb-4 text-lg font-light text-gray-500 dark:text-gray-400'>Please add some items in the cart. </p>
                <a  href='index.php' class='mr-2 cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>
                Continue Shopping
                <svg class='rtl:rotate-180 w-3.5 h-3.5 ms-2' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 14 10'>
                <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13 5H1m0 0 4 4M1 5l4-4'/>
                </svg>
                </a> 
                </div>
                ";
            }
            else{
        ?>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">
                    Product name
                </th>
                <th scope="col" class="px-4 py-4">
                    Product Image
                </th>
                <th scope="col" class="px-4 py-4">
                    Category
                </th>
                <th scope="col" class="px-6 py-4">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ip=$_SESSION['username'];;
            $query="select * from cart where ip='$ip'";
            $res_cart=mysqli_query($conn,$query);
            if (!$res_cart) {
                die("Error in cart query: " . mysqli_error($conn));
            }
            
            while($row=mysqli_fetch_assoc($res_cart)){
                $id=$row['product_id'];
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
                    $category=$cat_res['category_title'];

                    echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                    <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                        $product_title
                    </th>
                    <td class='px-6 py-4'>
                        <img class='w-16 h-16 object-cover' src='./admin/product_images/$product_image'>
                    </td>
                    <td class='px-6 py-4'>
                        
                        $category
                    </td>
                    <td class='px-6  py-4'>
                        $$product_price
                    </td>
                    <td class='px-0 py-4'>
                    <a href='cart_page.php?id=$id' type='button' name='remove-btn' class='cursor-pointer focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-6 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'>Remove</button>
                    </a>
                </tr>";   
                
                    
                }
            }
           
if(isset($_GET['id'])){
    $ip=$_SESSION['username'];;
    $id=$_GET['id'];
    $delete_query="delete  from cart where product_id=$id and ip='$ip'";
    $delete_product=mysqli_query($conn,$delete_query); 
    if($delete_product){
        echo "<script>alert('Item deleted succesfully')</script>";
        echo "<script>window.open('cart_page.php','_self')</script>";
    }
    
}


            ?>
              </tbody>
    </table>
    <h1 class="text-white mt-4 flex flex-row gap-2">
    <?php
    
    $ip=$_SESSION['username'];
    $query="select * from cart where ip='$ip'";
    $res=mysqli_query($conn,$query);
    $total=0;
    while($rows=mysqli_fetch_assoc($res)){
        if(isset($rows['price'])){
            $val = $rows['price'];
            $total += $val;
        }
    }

    echo "Total Price  -  <p class='text-gray-300'> $$total</p>";

    ?></h1>
    <hr class="h-px mb-4 mt-2 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="mt-2 ">
    <a  class="mr-2 cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Continue Shopping
    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
    </svg>
    </a>    
    <a  href='checkout.php' class="mr-2 cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Proceed to checkout
    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 9h2m3 0h5M1 5h18M2 1h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z"/>
   
    
    </svg>
    </a>
    <?php
            }
        }
            else{
                echo "<script>window.open('login.php','_self')</script>";
            }
    ?>
    

</div>
</div>
      </div>
    </div>


</body>

</html>

<?php

?>