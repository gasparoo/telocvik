<?php session_start(); 

if(! isset($_SESSION['LOGGED_IN_ADMIN_ID'])) {

header("Location: login.php");
exit;
}
require_once '../_inc/database.php';


function get_comments()
{
    global $con;
    $result = mysqli_query($con, "SELECT comments.id, comments.comment, users.name, products.title FROM `comments` INNER JOIN products ON products.id=comments.post_id INNER JOIN users ON users.id=comments.user_id  ORDER BY comments.id DESC");

    if(! $result) {
        return 2; 
    }
    if(mysqli_num_rows($result) > 0){

        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $comments;
    }
    return 0;
}

$comments = get_comments();


// CSRF token
function create_token()
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['_token'] = $token;
    echo '<input type="hidden" name="_token" value="' . $token . '">';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Products Listings</title>
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
            colors: {
                darkish: '#000000',
                border_gray: '#c1b8b8',
                rosed: '#d32e3f',
                grayish: '#c7d0d8',
                whitener: '#ffffff'
            }
            }
        }
        }
    </script>
        
        
   <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
</head>

<body class="bg-grayish">

<!-- Logo -->
<div class="container-fluid text-center">
    <a href="./"><img src="../images/logo.png" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg" alt="Logo" width="100" height="80"></a>
</div>



<div class="container mx-auto">
    <div class="text-2xl font-medium text-center text-darkish border-b border-rosed ">
        <ul class="flex flex-wrap -mb-px">
           
            <li class="mr-2">
                <a href="logout.php" class="inline-block p-4 rounded-lg hover:text-darkish hover:border-b-2 hover:border-rosed hover:bg-whitener">
                    Odhlásit se
                </a>
            </li>
             
        </ul>
    </div>
</div>

<!-- Main -->

<div class="container mx-auto px-4 py-8 w-full md:w-1/2 lg:w-1/2 xl:w-1/2 ">
    <div class="bg-white shadow-md rounded-lg p-6 mt-8">
        <?php if(isset($_SESSION['ERROR'])): ?>
  
         <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
            <?= $_SESSION['ERROR']; ?>
         </div>

        <?php unset($_SESSION['ERROR']); endif; ?>

        <?php if(isset($_SESSION['SUCCESS'])): ?>
  
        <div class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700 mb-3" role="alert">
            <?= $_SESSION['SUCCESS']; ?>
        </div>

        <?php unset($_SESSION['SUCCESS']); endif; ?>

      <h1 class="text-2xl font-semibold text-gray-700 mb-6">Komentáře</h1>
  
      <!-- komentáře -->
      <table class="table-auto">
  <thead>
    <tr>
      <th>Komentáře</th>
      <th>Produkty</th>
      <th>Uživatelé</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

  <?php if($comments > 0){ ?>
  <?php foreach($comments as $comment): ?>
    <tr >
      <td class="border-r-2 p-2 border_gray"><?= $comment['comment'] ?></td>
      <td class="border-r-2 p-2 border_gray"><?= $comment['title'] ?></td>
      <td class="border-r-2 p-2 border_gray"><?= $comment['name'] ?></td>
      <td class="border-r-2 p-2 border_gray">

      <form action="controller/AdminController.php" method="post">
        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
        <button type="submit" name="delete_comment" onclick="return(confirm('Are you sure to delete comment?'))" class="bg-red-500 rounded p-2 text-gray-100">Delete</button>
      </form>
      </td>
    </tr>
   <?php endforeach; ?>
   <?php } else{ ?>
    <td colspan="4" class="pt-5 text-red-500">Komentář nenalezen.</td>
    <?php } ?>
</tbody>
</table>

    </div>
  </div>



</body>

</html>