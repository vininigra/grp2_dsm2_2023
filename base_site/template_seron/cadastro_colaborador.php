<?php
require_once('Classes/Colaborador.php');
// Backend do cadastro de usuários do HTML

// Realizando a checagem do método de requisicao
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $colaborador = new Colaborador();

    //Declarando as variaveis recebidas via POST
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $confirmasenha = $_POST['confirmasenha'];

    //Realizando as verificacoes das variaveis
    $colaborador->verificaNome($nome);
    $colaborador->verificaEmail($email);
    $colaborador->comparaSenha($senha, $confirmasenha);

    // Se todos os campos foram preenchidos corretamente, cadastra o colaborador
    $colaborador->cadastrar($nome, $cpf, $email, $senha);

    // Destroi o objeto colaborador e fecha a conexao com o banco de dados
    unset($colaborador);
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Colaborador</title>
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
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        form input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>

        <label for="confirmasenha">Confirmar Senha:</label>
        <input type="password" name="confirmasenha" id="confirmasenha" required>

        <input type="submit" value="Cadastrar" onclick="showAlert('Colaborador cadastrado com sucesso!')">
    </form>
</body>
</html>