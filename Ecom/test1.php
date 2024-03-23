<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website using mysql and php</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-cyan-400"> 
    <div class="container min-w-[100vw]">
       <nav class="bg-white flex justify-between items-center h-16 ">
        <a href="#" class="text-4xl font-bold px-3 ">Akash</a>
        <div class="dp absolute top-full   text-xl max-lg:bg-white w-full text-center flex flex-col lg:static lg:flex-row lg:gap-8 ">
            <ul class="lg:flex lg:flex-row lg:gap-8 lg:ml-auto ">
                <li class="py-2 duration-500 hover:text-cyan-500 "><a href="#">Home</a></li>
                <li class="py-2 duration-500 hover:text-cyan-500 "><a href="#">About</a></li>
                <li class="py-2 duration-500 hover:text-cyan-500 "><a href="#">Contact</a></li>
            </ul>
            <div class="flex flex-col lg:flex-row lg:gap-8 lg:mr-12">
                <button class="py-2 duration-500 hover:text-cyan-500 ">Login</button>
                <button class="py-2 duration-500 hover:text-cyan-500 ">Sign up</button>
            </div>
        </div>
        <div class="menu lg:hidden"><i class="fa-solid fa-bars text-2xl px-3"></i></div>

       </nav>


    </div>
    <script>
        const menu=document.querySelector('.menu');
        const dp=document.querySelector('.dp');
        
        menu.addEventListener('click',()=>{
            dp.classList.toggle('top-16')
        })
    </script>
</body>

</html>

<?php

?>