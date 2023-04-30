


<?php

require_once('Classes/Participante.php');
// Backend do cadastro de usuários do HTML


print_r($_POST);
$participante = new Participante;



$nome = $_POST['name'];
$email = $_POST['email'];
$idade = $_POST['dt_nascimento'];
$senha = $_POST['senha'];

$participante->cadastrar($nome,$idade,$email,$senha);







?>
