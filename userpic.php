<?php
require_once('lib/janja.php');

session_start();

if(isset($_FILES['upfile'])) {
	$tmp = $_FILES['upfile']['tmp_name'];
	$filename = md5(date("Y-m-d H:i:s")) . '.jpg';
	$foto = 'img/tmp/' . $filename;
	move_uploaded_file($tmp, $foto);
	$template['foto'] = $foto;
}


$template['page'] = 'user/userpic';
require_once('template/crop.php');


?>
