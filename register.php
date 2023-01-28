<?php session_start();

if(isset($_SESSION['LOGGED_IN_USER_ID'])){
  header("Location:index.php");
  exit;
 }
require_once '_inc/config.php';
include_once 'layout/header.php'; 
include_once 'layout/navbar.php'; 

// CSRF
function create_token()
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['_token'] = $token;
    echo '<input type="hidden" name="_token" value="' . $token . '">';
}
?>


  <div class="container mx-auto px-4 py-8 w-full md:w-1/2 lg:w-1/3 xl:w-1/3 mt-8">
    <div class="bg-white shadow-md rounded-lg p-6 mt-8">
        <?php if(isset($_SESSION['ERROR'])): ?>
  
         <div class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
            <?= $_SESSION['ERROR']; ?>
         </div>

        <?php unset($_SESSION['ERROR']); endif; ?>
      <h1 class="text-2xl font-semibold text-gray-700 mb-6">Registrace</h1>
      <form action="_inc/UserController.php" method="POST">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            Jméno
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" type="text" placeholder="Username">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
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

        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
           Potvrď heslo
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="confirm_password" name="confirm_password" type="password" placeholder="******************">
        </div>
        
        <div class="mb-6">
         <div class="g-recaptcha w-full" data-sitekey="<?= CAPTCHA_SITE_KEY; ?>"></div>
        </div>

        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 text-white w-1/4 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="signUpBtn" type="submit">
           Registrace 
          </button>
          <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="login.php">
              
            Přihlásit se
          </a>
          <?= create_token(); ?>
        </div>
      </form>
    </div>
  </div>

