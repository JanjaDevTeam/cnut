<?php
require_once("model/database.php");
require_once("model/colaboracao.php");
require_once("model/projeto.php");
require_once('lib/janja.php');

$db = new Database;

$colab= $db->getBackersByProjeto(2);
Janja::Debug($colab);

?>
