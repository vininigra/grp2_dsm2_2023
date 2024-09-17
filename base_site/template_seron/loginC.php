<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login participante</title>
</head>
<body>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
    
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
<?php
require_once('Classes/Participante.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['email']) && isset($_POST['senha'])){
        $pessoa = new Colaborador($);
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $resultado = $pessoa->login($email, $senha);
        if($resultado == "Email ou senha incorretos"){
            echo "<p style='color:red'>$resultado</p><br>";
        }
    }
}
?>