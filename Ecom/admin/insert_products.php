<?php
        include("../db.php");
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['submit'])){
                $product_title=$_POST['name'];
                $product_keyword=$_POST['product_keyword'];
                $product_brand=$_POST['brand'];
                $product_category=$_POST['category'];
                $product_description=$_POST['description'];
                $item_weight=$_POST['item-weight'];
                $product_price=$_POST['price'];
                $product_status='true';

                // images
                $primary_image=$_FILES['primary_image']['name'];
                $secondary_image=$_FILES['secondary_image']['name'];
                $backdrop_image=$_FILES['backdrop_image']['name'];

                // temp images

                $temp_primary_image=$_FILES['primary_image']['tmp_name'];
                $temp_secondary_image=$_FILES['secondary_image']['tmp_name'];
                $temp_backdrop_image=$_FILES['backdrop_image']['tmp_name'];

                if($product_brand=='' or $product_title=='' or $product_keyword=='' or $product_category=='' or $product_description=='' or $item_weight=='' or $primary_image=='' or $secondary_image=='' or $backdrop_image==''){
                    echo "<script>alert('Please fill out all the fields')</script>";
                    exit();
                }
                else{
                    move_uploaded_file($temp_primary_image,"./product_images/$primary_image");
                    move_uploaded_file($temp_secondary_image,"./product_images/$secondary_image");
                    move_uploaded_file($temp_backdrop_image,"./product_images/$backdrop_image");

                    //query

                    $insert_query="insert into products(product_title,product_description,product_keyword,category_id,brand_id,product_price,primary_image,secondary_image,backdrop_image,item_weight,date,status) values(
                        '$product_title','$product_description','$product_keyword','$product_category','$product_brand','$product_price','$primary_image','$secondary_image','$backdrop_image','$item_weight',NOW(),'$product_status'
                    )";
                    $res=mysqli_query($conn,$insert_query);
                    if($res){
                        echo "<script>alert('Sucessfully inserted')</script>";
                    }
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
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new product</h2>
      <form action="#" method="post" enctype="multipart/form-data">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                  <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
              </div>
              <div class="w-full">
                  <label for="product_keyword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Keyword</label>
                  <input type="text" name="product_keyword" id="product_keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product Keyword" required="">
              </div>
              <div>
                  <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                  <select id="brand" name="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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
                  <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                  <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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
              <div class="w-full">
                  <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                  <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
              </div>
              
              <div class="w-full">
                 <label for="primary_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primary Image</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="primary_image" name="primary_image" type="file">
              </div>
              <div class="w-full">
                 <label for="secondary_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Secondary Image</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="secondary_image" name="secondary_image" type="file">
              </div>
              <div class="w-full">
                 <label for="backdrop_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Backdrop Image</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="backdrop_image" name="backdrop_image" type="file">
              </div>
              <div>
                  <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Weight (kg)</label>
                  <input type="number" name="item-weight" id="item-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
              </div> 
              <div class="sm:col-span-2">
                  <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                  <textarea id="description" name="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
              </div>
          </div>
          <button type="submit" name="submit" class=" mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Add product
          </button>
      </form>
  </div>
</section>


</div>
</body>
</html>