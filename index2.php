<?php 
require_once '_inc/database.php'; 
require_once '_inc/product_functions.php'; 

$products = getHomeProducts();

include_once 'layout/header.php'; 
include_once 'layout/navbar.php';
?>


<!-- responzivní -->
<section class="overflow-hidden text-gray-700 ">
    <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
        <div class="flex flex-wrap -m-1 md:-m-2">

          <?php foreach($products as $product): ?>
            <div class="flex flex-wrap xl:w-1/3 lg:w-1/3 md:w-1/2">
                <div class="w-full p-1 md:p-2">
                <a href="product_info.php?product=<?= $product['id'] ?>">
                    <img alt="gallery" class="block object-cover object-center w-full  rounded-lg" src="images/homepage/<?= $product['img1'] ?>">
                </a>
                </div>
            </div>
            <div class="flex flex-wrap xl:w-1/3 lg:w-1/3 md:w-1/2">
                <div class="w-full p-1 md:p-2">
                <a href="product_info.php?product=<?= $product['id'] ?>">

                    <img alt="gallery" class="block object-cover object-center w-full  rounded-lg" src="images/homepage/<?= $product['img2'] ?>">
                </a>
                </div>
            </div>
            <div class="flex flex-wrap xl:w-1/3 lg:w-1/3 md:w-1/2">
                <div class="w-full p-1 md:p-2">
                <a href="product_info.php?product=<?= $product['id'] ?>">

                    <img alt="gallery" class="block object-cover object-center w-full  rounded-lg" src="images/homepage/<?= $product['img3'] ?>">
                </a>
                </div>
            </div>
           <?php endforeach; ?>

        </div>
    </div>
</section>

<?php include_once 'layout/footer.php'; ?>