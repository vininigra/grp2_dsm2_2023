


<?php
include "conexao.php";

// Backend do cadastro de usuários do HTML
print_r($_POST);

$nome = $_POST['name'];
$email = $_POST['email'];
$nascimento = $_POST['dt_nascimento'];
$senha = $_POST['senha'];

$sql = "INSERT INTO label VALUES('$nome', '$email', $dt_nascimento, '$senha')";






?>
