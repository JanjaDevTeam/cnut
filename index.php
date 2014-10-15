<?php
require_once('controller/controller_user.php');
require_once('lib/janja.php');

session_start();


$ct = new ControllerUser;
if (isset($_SESSION['id']) && !isset($_SESSION['fbId'])) {
	if (!file_exists('img/userpics/' . $_SESSION['id'] . '.jpg')) {
		$template['alertaFoto'] = true;
	}
}


//$template['menu'] = '';
$template['page'] = "main";
require_once('template/main.php');
?>
