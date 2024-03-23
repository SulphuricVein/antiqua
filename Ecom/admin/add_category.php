<?php
include("../db.php");
$currentFile = $_SERVER["PHP_SELF"];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST['cat_btn'])) {
        $cat_title = $_POST['category'];
        $select_query = "SELECT * FROM categories WHERE category_title = '{$cat_title}'";
        $res_query = mysqli_query($conn, $select_query);
        $nrows = mysqli_num_rows($res_query);

        if ($nrows > 0) {
            echo "<script>alert('Category already exists!');</script>"; 
        } else {
            // Brand does not exist, proceed with insertion
            $insert_query = "INSERT INTO categories (category_title) VALUES ('{$cat_title}')";
            $res = mysqli_query($conn, $insert_query);
            $res ? print "<script>alert('Category has been added successfully');</script>" : '';
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

<div class="container min-w-[100vw]">
   

<form class="max-w-sm mx-auto mt-20" method="post">
  
  <div class="mb-5">
    <label for="category" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white " >Add Category</label>
    <input type="text" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="category" required placeholder="Add a category">
  </div>
 
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="cat_btn">Add</button>
</form>
 



</div>
</body>
</html>