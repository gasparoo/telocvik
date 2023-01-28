<?php session_start();

require_once '_inc/database.php'; ?>
<?php require_once '_inc/product_functions.php';

if (!isset($_GET['product']) || empty($_GET['product'])) {
    redirect("./");
}

$id =  (int) get_safe_value($_GET['product']);
$product = getProductByID($id);

if ($product[0] == 0) redirect('./');

$comments = getComments($id);

?>
<?php include_once 'layout/header.php'; ?>


<?php include_once 'layout/navbar.php'; ?>


<!--  obrázek -->
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Informace o produktu</h1>
    
    <!-- informace -->
    <div class="col-span-4 my-10">
        <div class="text-dark-900">
            <div class="text-2xl mb-5"><?= $product[0]['title']; ?></div>

            <?= $product[0]['description']; ?>
        </div>
        
    </div>

    <div class="grid grid-col-3 md:grid-cols-4  gap-4">


        <?php if ($product[1] != 0) : ?>
            <?php foreach ($product[1] as $image) : ?>
                <!-- Tricko bile s log -->
                <div class="col-span-3 md:col-span-2 lg:col-span-1 xl:col-span-1">
                    <img src="images/products/<?= $image['image']; ?>" alt="Image 2" class="block object-cover object-center w-full h-full cursor-pointer rounded-lg">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>


<!-- komentář -->
<div class="container mx-auto md:w-1/2 lg:w-1/2 xl:w-1/2 mt-20">

    <?php if(isset($_SESSION['SUCCESS'])): ?>
        
        <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
            Tvůj komentář byl přidaný.
         </div>


    <?php unset($_SESSION['SUCCESS']); endif; ?>

    <div class="bg-white rounded-lg p-4 shadow-md">
        <h2 class="text-2xl font-bold mb-4">Komentáře (<?= $comments['comments_count']; ?>)</h2>


        <?php if($comments['comments'] != 0): ?>
        <?php foreach($comments['comments'] as $comment): ?>
            <div class="mb-4 border-b pb-4">
            
            <div class="flex flex-col">
    
                <h3 class="text-lg font-bold mb-2"><?= $comment['name'] ?></h3>

                <p class="text-base leading-relaxed mb-4">
                   <?= $comment['comment'];?>

                </p>
            </div>

        </div>
        <?php endforeach; ?>

        <?php endif; ?>

        <!-- přidávání komentáře -->
        <?php if(isset($_SESSION['LOGGED_IN_USER_ID'])): ?>
        <form class="flex flex-col mt-4" method="POST" action="_inc/UserController.php">
            
            <textarea class="bg-gray-200 rounded-lg p-4 mb-4" name="comment" placeholder="Leave a comment" required></textarea>
            <input type="hidden" name="post_id" value="<?= $id; ?>">

             
             <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit" name="btnComment">
                Přidat komentář
            </button>
        </form>
            <?php else: ?>
                <a href="login.php" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                    Přihlásit se k přidání komentáře
                </a>
            <?php endif; ?>
    </div>

</div>

<?php include_once 'layout/footer.php'; ?>