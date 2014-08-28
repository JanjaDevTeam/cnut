<?php
require_once('lib/janja.php');

session_start();

Janja::Debug($_SESSION);

$content = "main";
require_once('template/main.php');
?>
