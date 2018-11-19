<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
$_SESSION['uname'] = "";
$_SESSION['psw'] = "";
$_SESSION['email'] = "";
header('Location:index.php');
 ?>
