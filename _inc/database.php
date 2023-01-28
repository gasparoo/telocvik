<?php

require_once 'config.php';

$con =  new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($con->connect_error) {
	die("Connection error"). $con->connect_errno;	 
}
$con->set_charset(DB_CHARSET);

function redirect($url)
{
?>
    <script>
        window.location.href = "<?= $url; ?>"
    </script>
<?php
 exit;
}

function get_safe_value($value)
{
    global $con;
    $sql_injection = trim(mysqli_real_escape_string($con, $value));
    $xss = htmlspecialchars(strip_tags($sql_injection));
    return $xss;
}