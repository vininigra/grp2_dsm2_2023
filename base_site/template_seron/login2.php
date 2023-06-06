<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="./img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap2.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/uf-style.css">
    <title>Área de Login</title>
    <style>
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
    </style>
  </head>
  <body>
    <form method="POST" action="">
      <div class="uf-form-signin">
        <div class="text-center">
          <a href="index.php"><img src="./img/logo2.png" alt="" width="70%"></a><p></p>
          <h1 class="text-white h3">Área de Login</h1><p>
        </div>
        <form class="mt-4">
        <div class="input-group uf-input-group input-group-lg mb-3">
              <span class="input-group-text fa fa-envelope"></span>
              <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" required>
            </div>
            <div class="input-group uf-input-group input-group-lg mb-3">
              <span class="input-group-text fa fa-lock"></span>
              <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
            </div>
            <div class="input-group uf-input-group input-group-lg mb-3">
                <span class="input-group-text fa fa-user"></span>
              <!-- <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required> -->
              <select name="tipo" id="tipo">
              <option value="colaborador">Colaborador</option>
              <option value="participante">Participante</option>
              </select>
            </div>
            <div class="d-grid mb-4">
              <button type="submit" class="btn btn-outline-light">Entrar</button>
            </div>
                <div class="mt-4 text-center">
              <span class="text-white">Não tem conta?</span>
              <a href="register.html">Cadastre-se</a>
            </div>
          </div>
        </form>
      </div>
    </form>

    <!-- JavaScript -->

    <!-- Separate Popper and Bootstrap JS -->
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
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
