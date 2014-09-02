<?php
require_once('lib/janja.php');

session_start();

$template['menu'] = 'enviar';

if(isset($_SESSION['id'])) {
	$template['page'] = 'projeto/termos';
} else {
	$template['page'] = "projeto/enviar_projeto";
}


require_once('template/main.php');
?>
