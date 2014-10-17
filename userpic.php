<?php
require_once('lib/janja.php');
require_once('model/database.php');

session_start();

$db = new Database;

if(isset($_FILES['upfile'])) {
	$tmp = $_FILES['upfile']['tmp_name'];
	$filename = md5(date("Y-m-d H:i:s")) . '.jpg';
	$foto = 'img/tmp/' . $filename;
	move_uploaded_file($tmp, $foto);
	$template['foto'] = $foto;
}

$template['menuPerfil'] = 0;
$template['page'] = 'user/userpic';
require_once('template/crop.php');


?>
