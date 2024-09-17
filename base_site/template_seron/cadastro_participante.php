<?php
require_once('Classes/evento.php');
require_once('Classes/Participante.php');
// Backend do cadastro de usuários do HTML

// Realizando a checagem do método de requisicao
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evento = new Evento();
    $participante = new Participante();

    //Declarando as variaveis recebidas via POST
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $idade = $_POST['dt_nascimento'];
    $senha = $_POST['senha'];
    $confirmasenha = $_POST['confirmaSenha'];

    //Realizando as verificacoes das variaveis
    $participante->verificaNome($nome);
    $participante->verificaEmail($email);
    $participante->verificaData($idade);
    $participante->comparaSenha($senha, $confirmasenha);

    // Se todos os campos foram preenchidos corretamente, cadastra o participante
    $participante->cadastrar($nome, $idade, $email, $senha);

    // Destroi o objeto participante e fecha a conexao com o banco de dados
    unset($participante);
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Participante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fbfbfb;
        }
        
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #36802d;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        form label {
            display: block;
            margin-bottom: 8px;
        }
        
        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        form input[type="submit"] {
        background-color: #36802d;
        color: #fff;
        font-size: 15px;
        font-weight: 500;
        padding: 10px 16px;
        text-decoration: none;
        border: 2px solid #36802d;
        transition: all 0.5s;
        }
        
        form input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <form method="POST" action="">
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="dt_nascimento">Data de Nascimento:</label>
        <input type="date" name="dt_nascimento" id="dt_nascimento" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>

        <label for="confirmaSenha">Confirmar Senha:</label>
        <input type="password" name="confirmaSenha" id="confirmaSenha" required>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>