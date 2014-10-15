<?php 
require 'lib/fbconfig.php';
$facebook->destroySession();  // to destroy facebook sesssion
$_SESSION = Null;
session_destroy();
/*
$app = explode("/", $_SERVER['REQUEST_URI'])[1];
header("Location: http://" . $_SERVER['HTTP_HOST'] . "/" . $app . "/logar.php");
*/
header("Location: http://localhost/cnut/logar.php");
?>
