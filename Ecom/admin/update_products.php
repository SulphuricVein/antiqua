<?php
include("../db.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['submit'])){
        $product_id=$_GET['up'];
        $product_title=$_POST['name'];
        $product_keyword=$_POST['product_keyword'];
        $product_brand=$_POST['brand'];
        $product_category=$_POST['category'];
        $product_description=$_POST['description'];

        $product_price=$_POST['price'];
        $product_status='true';

        // images
        $primary_image=$_FILES['primary_image']['name'];
        $secondary_image=$_FILES['secondary_image']['name'];

        // temp images
        $temp_primary_image=$_FILES['primary_image']['tmp_name'];
        $temp_secondary_image=$_FILES['secondary_image']['tmp_name'];

        // Ensure file inputs are not empty
        if(!empty($primary_image) && !empty($secondary_image)) {
            
            move_uploaded_file($temp_primary_image,"./product_images/$primary_image");
            move_uploaded_file($temp_secondary_image,"./product_images/$secondary_image");
        } else {
            echo "<script>alert('Please upload images')</script>";
            exit();
            
        }

        $update_query = "UPDATE products SET 
            product_title = '$product_title',
            product_description = '$product_description',
            product_keyword = '$product_keyword',
            category_id = '$product_category',
            brand_id = '$product_brand',
            product_price = '$product_price',
            primary_image = '$primary_image',
            secondary_image = '$secondary_image',
            date = NOW(),
            status = '$product_status'
            WHERE product_id = $product_id";
            
        $res=mysqli_query($conn,$update_query);
        if($res){
            echo "<script>alert('Successfully updated')</script>";
            echo "<script>window.open('view_products.php','_self')</script>";
        } else {
            // Handle database update failure
            echo "<script>alert('Failed to update product')</script>";
        }
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

<div class="container dark min-w-[100vw]">
    <div class="nav dark">
        <?php
            include("anavbar.php");
        ?>
    </div>
    <section class="bg-white dark:bg-gray-900">
    <?php
        $up=$_GET['up'];
      $query="select * from products where product_id=$up";
      $res_cart=mysqli_query($conn,$query);
      if (!$res_cart) {
          die("Error in cart query: " . mysqli_error($conn));
      }
      
      while($row=mysqli_fetch_assoc($res_cart)){
          $id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_price=$row['product_price'];
          $product_keyword=$row['product_keyword'];
          $product_brand=$row['brand_id'];
          $product_category=$row['category_id'];
          $product_image=$row['primary_image'];

          $product_description=$row['product_description'];
          $secondary_image=$row['secondary_image'];
          $backdrop_image=$row['backdrop_image'];
      
      }
    ?>


    <div class='py-8 px-4 mx-auto max-w-2xl lg:py-16'>
    <h2 class='mb-4 text-xl font-bold text-gray-900 dark:text-white'>Update product</h2>
    <form action='#' method='post' enctype='multipart/form-data'>
        <div class='grid gap-4 sm:grid-cols-2 sm:gap-6'>
            <div class='sm:col-span-2'>
                <label  for='name' class='block mb-2 text-sm font-medium text-gray-900 dark:text-white'>Product Name</label>
                <input value="<?php echo $product_title?>" type='text' name='name' id='name' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500' placeholder='Type product name' required=''>
            </div>
            <div class='w-full'>
                <label for='product_keyword' class='block mb-2 text-sm font-medium text-gray-900 dark:text-white'>Product Keyword</label>
                <input value="<?php echo $product_keyword?>" type='text' name='product_keyword' id='product_keyword' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500' placeholder='Product Keyword' required=''>
            </div>
            <div>
                <label for='brand' class='block mb-2 text-sm font-medium text-gray-900 dark:text-white'>Brand</label>
                <select id='brand'  name='brand' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'>
                    <?php
                        $query='select * from brands';
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res)){
                            $title=$row['brand_title'];
                            $id=$row['brand_id'];
                            echo "<option value='$id'>$title</option>";
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for='category' class='block mb-2 text-sm font-medium text-gray-900 dark:text-white'>Category</label>
                <select id='category' name='category' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'>
                    <?php
                        $query='select * from categories';
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res)){
                            $title=$row['category_title'];
                            $id=$row['category_id'];
                            echo "<option value='$id'>$title</option>";
                        }
                    ?>
                </select>
            </div>
            <div class='w-full'>
                <label for='price' class='block mb-2 text-sm font-medium text-gray-900 dark:text-white'>Price</label>
                <input type='number' value="<?php echo $product_price?>" name='price' id='price' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500' placeholder='$2999' required=''>
            </div>
          
            <div class='w-full '>
            <img class='w-[200px] h-[220px] mb-2' src='<?php echo "./product_images/$product_image"; ?>' alt='Product Image'>

            <label for='primary_image' class='block mb-2 text-sm font-medium text-gray-900 dark:text-white'>Primary Image</label>
    
        <input  class='block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' aria-describedby='user_avatar_help' id='primary_image' name='primary_image' type='file'>
        </div>
            <div class='w-full'>
            <img class='w-[200px] h-[220px] mb-2' src='<?php echo "./product_images/$secondary_image"; ?>' alt='Product Image'>

            <label for='secondary_image' class='block mb-2 text-sm font-medium text-gray-900 dark:text-white'>Secondary Image</label>
                <input class='block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400' aria-describedby='user_avatar_help' id='secondary_image' name='secondary_image' type='file'>
            </div>
    
            <div class='sm:col-span-2'>
    <label for='description' class='block mb-2 text-sm font-medium text-gray-900 dark:text-white'>Description</label>
    <textarea id='description' name='description' rows='8' class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500' placeholder='Your description here'><?php echo $product_description; ?></textarea>
</div>

        </div>
        <button type='submit' name='submit' class=' mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>
            Update product
        </button>
    </form>
</div>

</section>


</div>
</body>
</html>