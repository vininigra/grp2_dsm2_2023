<?php
require_once('Classes/Participante.php');
session_start();
$_SESSION = array();
$pessoa = new Participante();
$pessoa->logout();
header('location: index.php');
?>