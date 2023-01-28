<?php session_start();

require_once 'database.php';
require_once 'product_functions.php';

// ověření uživatele
function login($username, $password)
{
    global $con;
    $userSql = "SELECT * FROM `users` WHERE `email` = '$username' LIMIT 1";
    $result = mysqli_query($con, $userSql);
    if (!$result) return 0;

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {

            $_SESSION['LOGIN_USER_ID'] = $row['id'];
            $_SESSION['LOGIN_USERNAME'] = $row['name'];
            $_SESSION['LOGIN_USER_EMAIL'] = $row['email'];
            $_SESSION['LOGIN_USER'] = true;

            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

// vytvoření CSRF
function create_token()
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['_token'] = $token;
    echo '<input type="hidden" name="_token" value="' . $token . '">';
}

function validate_token($value)
{
    if ($_SESSION['_token'] == $value) {
        return true;
    } else {
        return false;
    }
}

// registrace
function setUser($name, $email, $password)
{
    global $con;

    $password = password_hash($password, PASSWORD_DEFAULT);
    $userSql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name', '$email', '$password')";

    $user_result = mysqli_query($con, $userSql);
    if ($user_result) {
        return mysqli_insert_id($con);

    } else {
        return false;
    }
}

if (isset($_POST['signUpBtn'])) {

    if(! validate_token($_POST['_token'])){
      $_SESSION['ERROR'] = "Neoprávněný přístup";
      redirect('../register.php');
    }
 
    $name = get_safe_value($_POST['username']);
    $email = get_safe_value($_POST['email']);
    $password = get_safe_value($_POST['password']);
    $confirm_password = get_safe_value($_POST['confirm_password']);

    // reCaptcha
    $greCaptcha_response = get_safe_value($_POST['g-recaptcha-response']);

    $gCaptchaData = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". CAPTCHA_SECRECT_KEY . '&response='. $greCaptcha_response );

    $gCaptchaVerify = json_decode($gCaptchaData);

    // kontroly
    if(! $gCaptchaVerify->success){
        $_SESSION['ERROR'] = "Zaškrtněte reCaptchu.";
        redirect('../register.php');
    }

    if(! $gCaptchaVerify->hostname  == CAPTCHA_DOMAIN){
        $_SESSION['ERROR'] = "Neoprávněný přístup";
        redirect('../register.php');
    }

    if ($password !== $confirm_password) {
        $_SESSION['ERROR'] = "Hesla se neshodují";
        redirect('../register.php');
    }

    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);

    if (mysqli_num_rows($res)) {
        $_SESSION['ERROR'] = "Uživatel s tímto emailem již existuje";
        redirect('../register.php');
    }

        $encpass = password_hash($password, PASSWORD_BCRYPT);


        $insert_data = "INSERT INTO users (name, email, password)
        VALUES('$name', '$email', '$encpass')";

        $data_check = mysqli_query($con, $insert_data);

        if (!$data_check) {
            $_SESSION['ERROR'] = "Něco je špatně";
            redirect('../register.php');
        }


        $_SESSION['SUCCESS'] = "Přihlášení proběho v pořádku";

        redirect('../login.php');

}
    //přihlášení
if (isset($_POST['loginBtn'])) {


    // CSRF
    if(! validate_token($_POST['_token'])){
        $_SESSION['ERROR'] = "Neoprávněný přístup";
        redirect('../login.php');
    }

    // reCaptcha
    $greCaptcha_response = get_safe_value($_POST['g-recaptcha-response']);
    $gCaptchaData = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". CAPTCHA_SECRECT_KEY . '&response='. $greCaptcha_response );
    $gCaptchaVerify = json_decode($gCaptchaData);

    if(! $gCaptchaVerify->success){
        $_SESSION['ERROR'] = "Prosím zaškrtni reCaptchu.";
        redirect('../login.php');
    }

    if(! $gCaptchaVerify->hostname  == CAPTCHA_DOMAIN){

        $_SESSION['ERROR'] = "Neoprávněný přístup";
        redirect('../login.php');
    }
    $email = get_safe_value($_POST['email']);
    $password = get_safe_value($_POST['password']);
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    $num_rows = mysqli_num_rows($res);

    // kontrola údajů
    if (!$num_rows) {
        $_SESSION['ERROR'] = "Nejsi ještě zaregistrován, vytvoř si účet";
        redirect("../login.php");
    }

    $fetch = mysqli_fetch_assoc($res);
    $db_password = $fetch['password'];
    if (! password_verify($password, $db_password)) {
        $_SESSION['ERROR'] = "Nesprávné heslo!";
        redirect('../login.php');
    }
        
    $_SESSION['LOGGED_IN_USER_ID'] = $fetch['id'];
    $_SESSION['LOGGED_IN_USERNAME'] = $fetch['name'];
    $_SESSION['LOGGED_IN_USER_EMAIL'] = $fetch['email'];

    redirect('../index.php');

}

    // přidání komentáře
if(isset($_POST['btnComment'])){
    
    $data['comment'] = get_safe_value($_POST['comment']);
    $data['post_id'] = get_safe_value($_POST['post_id']);
    $data['date'] = date('Y-M-d');
    
    addComment($data);
 
    $_SESSION['SUCCESS'] = "Tvůj komentář byl přidán";

    redirect('../product_info.php?product='. $data['post_id']);
}


echo 'check';