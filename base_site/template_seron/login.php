

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login participante</title>
</head>
<body>
<form method="POST" action="">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>

    <label for="tipo">Tipo de Usuário:</label>
    <select name="tipo" id="tipo">
        <option value="colaborador">Colaborador</option>
        <option value="participante">Participante</option>
    </select>

    <input type="submit" value="Login">
</form>
</body>
</html>
<?php
session_start();

require_once('Classes/Participante.php');
require_once('Classes/Colaborador.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['email']) && isset($_POST['senha'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $tipo = $_POST['tipo'];
    
        if ($tipo === 'colaborador') {
            $colaborador = new Colaborador();
            $mensagem = $colaborador->login($email, $senha);
        } elseif ($tipo === 'participante') {
            $participante = new Participante();
            $mensagem = $participante->login($email, $senha);
        } else {
            $mensagem = "Tipo de usuário inválido.";
        }
    
        if ($mensagem === "Login realizado com sucesso!") {
            header('location:index.php');
            exit;
        } else {
            echo $mensagem;
        }
    }
    unset($pessoa);
}
?>