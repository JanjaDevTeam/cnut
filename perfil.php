<?php
require_once('lib/janja.php');
require_once('model/database.php');
require_once('model/user.php');

session_start();

$db = new Database;
$user = $db->getUserById($_SESSION['id']);

//Janja::Debug($user);
$template['menuPerfil'] = 0;
$template['page'] = "user/perfil";
$template['foto'] = Janja::Foto();
$template['nome'] = $user->getNome();
$template['email'] = $user->getEmail();
require_once('template/main.php');
?>
