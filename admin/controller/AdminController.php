<?php session_start();

require_once '../../_inc/database.php';


//  CSRF token
function validate_token($value)
{
    if ($_SESSION['_token'] == $value) {
        return true;
    } else {
        return false;
    }
}

//odstranění komentáře
if (isset($_POST['admin_login'])) {

    // Validate CSRF
    if(! validate_token($_POST['_token'])){
        $_SESSION['ERROR'] = "Unauthorized try";
        redirect('../login.php');
    }

    // Google reCaptcha
    
    // $greCaptcha_response = get_safe_value($_POST['g-recaptcha-response']);


    // $gCaptchaData = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". CAPTCHA_SECRECT_KEY . '&response='. $greCaptcha_response );

    // $gCaptchaVerify = json_decode($gCaptchaData);

    
    //if(! $gCaptchaVerify->success){
    //    $_SESSION['ERROR'] = "Please check the reCaptcha.";
    //    redirect('../login.php');
    // }

    // kontrola správného přihlášení pro admina
   // if(! $gCaptchaVerify->hostname  == CAPTCHA_DOMAIN){

    //    $_SESSION['ERROR'] = "Neoprávněný přístup!";
    //    redirect('../login.php');
    //}
    $email = get_safe_value($_POST['email']);
    $password = get_safe_value($_POST['password']);
    $check_email = "SELECT * FROM admins WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    $num_rows = mysqli_num_rows($res);

    // email
    if (!$num_rows) {
        $_SESSION['ERROR'] = "Špatné přihlašovací údaje.";

        redirect("../login.php");
    }
    // heslo
    $fetch = mysqli_fetch_assoc($res);
    $db_password = $fetch['password'];
    if (! password_verify($password, $db_password)) {
        $_SESSION['ERROR'] = "Špatné přihlašovací údaje.";
        redirect('../login.php');
    }
        

    $_SESSION['LOGGED_IN_ADMIN_ID'] = $fetch['id'];
    $_SESSION['LOGGED_IN_ADMIN_EMAIL'] = $fetch['email'];

    redirect('../index.php');

}
if(! isset($_SESSION['LOGGED_IN_ADMIN_ID'])) redirect('../');
//  přidání komentáře po vymazání adminem
if(isset($_POST['delete_comment'])){
    
    $comment_id = (int) get_safe_value($_POST['comment_id']);

   
    $result = mysqli_query($con, "DELETE FROM comments WHERE id='$comment_id'");

    $_SESSION['ERROR'] = "Něco je špatně";
    if(! $result) redirect('../'); 
 
    unset($_SESSION['ERROR']);

    $_SESSION['SUCCESS'] = "Tvůj komentář byl smazán";

    redirect('../');
}