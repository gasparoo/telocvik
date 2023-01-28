<?php session_start();

require_once '_inc/database.php';
require_once '_inc/product_functions.php'; 

include_once 'layout/header.php';
include_once 'layout/navbar.php';

$products = getHomeProducts();

 ?>


<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Produkty</h1>

    <div class="grid grid-cols-4 gap-4">
        <!-- Tricko bile s log -->
        <div class="col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-1">
            <a href="product_info.php?product=<?= $products[0]['id'] ?>">
                <img src="images/homepage/<?= $products[0]['img1'] ?>" alt="Image 2" class="block object-cover object-center w-full h-auto cursor-pointer rounded-lg">
            </a>
        </div>
        <div class="col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-1">
            <a href="product_info.php?product=<?= $products[0]['id'] ?>">
                <img src="images/homepage/<?= $products[0]['img2'] ?>" alt="Image 4" class="block object-cover object-center w-full h-auto cursor-pointer rounded-lg">
                <img src="images/homepage/<?= $products[0]['img3'] ?>" alt="Image 4" class="block object-cover object-center w-full h-auto cursor-pointer mt-10 rounded-lg">
            </a>
        </div>
        

        <!-- Mikina s log -->
        <div class="col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-1">
            <a href="product_info.php?product=<?= $products[1]['id'] ?>">
                <img src="images/homepage/<?= $products[1]['img1'] ?>" alt="Image 1" class="block object-cover object-center w-full h-auto cursor-pointer rounded-lg">
            </a>
        </div>
        <div class="col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-1">
            <a href="product_info.php?product=<?= $products[1]['id'] ?>">
                <img src="images/homepage/<?= $products[1]['img2'] ?>" alt="Image 3" class="block object-cover object-center w-full h-auto cursor-pointer rounded-lg">
                <img src="images/homepage/<?= $products[1]['img3'] ?>" alt="Image 3" class="block object-cover object-center w-full h-auto cursor-pointer rounded-lg mt-10">
            </a>
        </div>
        

        <!-- Tricko sedive s log -->
        <div class="col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-1">
            <a href="product_info.php?product=<?= $products[2]['id'] ?>">
                <img src="images/homepage/<?= $products[2]['img1'] ?>" alt="Image 3" class="block object-cover object-center w-full h-auto cursor-pointer rounded-lg">
            </a>
        </div>
        <div class="col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-1">
            <a href="product_info.php?product=<?= $products[2]['id'] ?>">
                <img src="images/homepage/<?= $products[2]['img2'] ?>" alt="Image 1" class="block object-cover object-center w-full h-auto cursor-pointer rounded-lg">
            </a>
        </div>
        <div class="col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-1">
            <a href="product_info.php?product=<?= $products[2]['id'] ?>">
                <img src="images/homepage/<?= $products[2]['img3'] ?>" alt="Image 3" class="block object-cover object-center w-full h-auto cursor-pointer rounded-lg ">
            </a>
        </div>
        

    </div>

</div>

<?php include_once 'layout/footer.php'; ?>
