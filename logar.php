<?php
require_once('model/database.php');
require_once('model/user.php');
require_once('controller/controller_login.php');
require_once('lib/fbconfig.php');
require_once('lib/janja.php');


// caso receba code, loga pelo fb
if(isset($_GET['code'])) {
	require_once('lib/fbconfig.php');
	
	$controller = new ControllerLogin;
	if(isset($fbuser)) {
		$controller->loginFb($fbemail, $fbfullname, $fbid);
	}
}


$template['page'] = 'logar';
require_once('template/main.php');
?>
