<?php
require_once('lib/janja.php');
$targ_w = $targ_h = 150;
$jpeg_quality = 90;

$src = $_POST['img'];

$image = imagecreatefromjpeg($src);
$orig_width = imagesx($image);
$orig_height = imagesy($image);

/*
print "$orig_width x $orig_height <br/>";

$proporcao = $orig_width / $_POST['screen_width'];
print "<br/>Proporcao: " . $proporcao;

Janja::Debug($_POST);
exit;
* */

$proporcao = ($orig_width / $_POST['scrw']);
$x = $_POST['x'] * $proporcao;
$y = $_POST['y'] * $proporcao;
$w = $_POST['w'] * $proporcao;
$h = $_POST['h'] * $proporcao;

$img_r = imagecreatefromjpeg($src);
$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
    $targ_w,$targ_h,$w,$h);

session_start();

header('Content-type: image/jpeg');
imagejpeg($dst_r, 'img/userpics/' . $_SESSION['id'] . '.jpg', $jpeg_quality);
header('location: perfil.php');
?>
