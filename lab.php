<?php
require_once('model/database.php');
require_once('controller/controller_login.php');
require_once('lib/janja.php');

$email = "brunocanongia@gmail.com";
$db = new Database;
$result = $db->verificarToken(4, 'senha');
Janja::Debug($result);

?>
