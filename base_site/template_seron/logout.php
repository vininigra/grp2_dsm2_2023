<?php
require_once('Classes/Participante.php');
session_start();
$_SESSION = array();
$pessoa = new Participante($servername, $username, $password, $dbname);
$pessoa->logout();
header('location: index.php');
?>