<?php
include('db.php');
include('common_function.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
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
if(isset($_POST['submit-btn'])){
    $name=$_POST['name'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $pay_method=$_POST['payment_method'];
    $ip=$_SESSION['username'];
    $pre_query="select * from cart where ip='$ip'";
    $pre_res=mysqli_query($conn,$pre_query);
    if(mysqli_num_rows($pre_res)>0){
        
    
    while($pre_arr=mysqli_fetch_assoc($pre_res)){
        $product_id=$pre_arr['product_id'];
        $price=$pre_arr['price'];
        
        $query="insert into orders(product_id,price,ip,contact,name,address) values('$product_id','$price','$ip','$contact','$name','$address')";
        $res=mysqli_query($conn,$query);
        if($res){
            echo "<script>alert('Order successfully placed')</script>";
        }else{
            echo "<script>alert('An error occured')</script>";
        }
        $del_query="delete from cart where ip='$ip'";
        $del_res=mysqli_query($conn,$del_query);
        echo "<script>window.open('index.php','_self')</script>";
    }
    $order_total="select * from orders where ip='$ip'";
    $order_res=mysqli_query($conn,$order_total);
    $SUMtotal=0;
    while($rows=mysqli_fetch_assoc($order_res)){
        if(isset($rows['price'])){
        $val = $rows['price'];
        $SUMtotal += $val;
    } 
}
    $ship_query="insert into shipping(total_price,ip) values('$SUMtotal','$ip')";
    $ship_res=mysqli_query($conn,$ship_query);
}

echo "<script>window.open('index.php','_self')</script>";
echo "<script>alert('An error occured')</script>";
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
    
    <link rel="stylesheet" href="style.css">
</head>
<body class='dark'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<div class="container min-w-[100vw] ">
    <nav>
        <?php
        include('navbar.php');
        ?>
    </nav>
    

<section class="bg-white dark:bg-gray-900">
  <div class="py-8 px-4 mx-auto max-w-2xl lg:pb-20">
      <h2 class="mb-6 text-xl font-bold text-gray-900 dark:text-white">Payment Details</h2>
      <form action="payment.php" method="post">
          <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
              <div class="sm:col-span-2">
                  <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                  <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your name" required="">
              </div>
              <div>
                  <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Password</label>
                  <input type="number" name="item-weight" id="item-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter password" required="">
              </div> 
              <div class="w-full">
                  <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                  <input type="text" name="contact" id="contact" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Contact Number" required="">
              </div>
              <div class="w-full">
              <?php
               
        ?>
                  <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                  <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 cursor-not-allowed" placeholder="$<?php echo $total
                  ?>" disabled required="">
              </div>
              <div>
                  <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method</label>
                  <select id="payment_method" name='payment_method' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                      <option selected="online">Online</option>
                      <option value="cash">Cash On-Delivery</option>    
                  </select>
              </div>
              
              <div class="sm:col-span-2">
                  <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                  <textarea id="address" name='address' rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your address here"></textarea>
              </div>
          </div>
          <button name='submit-btn' type="submit" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Place Order
          </button>
      </form>
  </div>
</section>

</div>
<footer>
      <?php
      include('footer.php');
      ?>
    </footer>
</body>
</html>