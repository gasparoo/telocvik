<?php session_start();
// echo password_hash('Admin@telocvik', PASSWORD_DEFAULT);
// admin@telocvik.com
if(isset($_SESSION['LOGGED_IN_ADMIN_ID'])){
 header("Location:index.php");
 exit;
}
require_once '../_inc/config.php';


//  CSRF token
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

<!-- Logo  -->
<div class="container-fluid text-center">
    <a href="./"><img src="../images/logo.png" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg" alt="Logo" width="100" height="80"></a>
</div>




  <div class="container mx-auto px-4 py-8 w-full md:w-1/2 lg:w-1/3 xl:w-1/3 mt-8">
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

      <h1 class="text-2xl font-semibold text-gray-700 mb-6">Admin Login</h1>
      <form action="controller/AdminController.php" method="POST">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Email
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="Email">
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            Heslo
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="******************">
          
        </div>
        
        <!-- <div class="mb-6">
         <div class="g-recaptcha w-full" data-sitekey="<?= CAPTCHA_SITE_KEY; ?>"></div>
         </div> -->

        <div class="flex items-center justify-between">
          <button class="bg-rosed hover:bg-darkish text-whitener w-1/4 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="admin_login" type="submit">
            Přihlásit se
          </button>
        
          <?= create_token(); ?>
        </div>
      </form>
    </div>
  </div>

