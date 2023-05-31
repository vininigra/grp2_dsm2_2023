<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login participante</title>
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
        
        form input[type="email"],
        form input[type="password"],
        form select {
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

    <?php
    session_start();

    require_once('Classes/Participante.php');
    require_once('Classes/Colaborador.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['email']) && isset($_POST['senha'])) {
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
                echo '<script>showAlert("' . $mensagem . '"); window.location.href = "index.php";</script>';
                exit;
            } else {
                echo '<script>showAlert("' . $mensagem . '");</script>';
            }
        }
        unset($pessoa);
    }
    ?>
</body>
</html>