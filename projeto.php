<?php
require_once('model/database.php');
require_once('model/projeto.php');
require_once('controller/controller_projeto.php');
require_once('lib/janja.php');

$db = new Database;

$projeto = $db->getProjeto(1);
Janja::Debug($projeto);

?>
