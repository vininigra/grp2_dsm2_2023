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
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="./img/favicon.png">
    <link rel="stylesheet" href="./css/bootstrap2.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/uf-style.css">
    <title>Área de cadastro</title>
  </head>
  <body>
    <div class="uf-form-signin">
      <div class="text-center">
        <a href="https://uifresh.net/"><img src="./img/logo2.png" alt="" width="60%"></a><p></p>
      <h1 class="text-white h3">Cadastro de conta</h1>
      </div>

      <form class="mt-4" method="POST" action="">
        <div class="input-group uf-input-group input-group-lg mb-3">
          <span class="input-group-text fa fa-user"></span>
          <input type="text" class="form-control" name="name" id="name" placeholder="name" required>
        </div>
        <div class="input-group uf-input-group input-group-lg mb-3">
          <span class="input-group-text fa fa-envelope"></span>
          <input type="text" class="form-control" name="email" id="email" placeholder="email" required>
        </div>
        <div class="input-group uf-input-group input-group-lg mb-3">
          <span class="input-group-text fa fa-user"></span>
          <input type="text" class="form-control" name="cpf" id="cpf" placeholder="cpf" required>
        </div>
        <div class="input-group uf-input-group input-group-lg mb-3">
          <span class="input-group-text fa fa-lock"></span>
          <input type="password" class="form-control" name="senha" id="senha" placeholder="senha" required>
        </div>
        <div class="input-group uf-input-group input-group-lg mb-3">
          <span class="input-group-text fa fa-lock"></span>
          <input type="password" class="form-control" name="confirmasenha" id="confirmasenha" placeholder="confirma senha" required>
        </div>
        <div class="d-grid mb-4">
          <button type="submit" class="btn btn-outline-light" value="Cadastrar">Cadastre-se</button>
        </div>
        <div class="mt-4 text-center">
          <span type="submit" class="text-white">Já possui cadastro?</span>
          <a href="login2.php">Entre</a>
        </div>
      </form>
    </div>

    <!-- JavaScript -->

    <!-- Separate Popper and Bootstrap JS -->
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>