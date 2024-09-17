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
    <title>Administrador</title>
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
          <h1 class="text-white h3">Administrador</h1><p>
        </div>
        <form class="mt-4">
        <div class="input-group uf-input-group input-group-lg mb-3">
              <span class="input-group-text fa fa-envelope"></span>
              <input type="text" class="form-control" name="user" id="user" placeholder="User" required>
            </div>
            <div class="input-group uf-input-group input-group-lg mb-3">
              <span class="input-group-text fa fa-lock"></span>
              <input type="password" class="form-control" name="password" id="senha" placeholder="Password" required>
            </div>
           
            <div class="d-grid mb-4">
              <button type="submit" class="btn btn-outline-light">Entrar</button>
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

    require_once('Classes/Administrador.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['user']) && isset($_POST['password'])) {
        $email = $_POST['user'];
        $senha = $_POST['password'];
        
        
        $adm = new Administrador();
        $pessoa = $adm->loginAdm($email, $senha);
       
        

        

        
      unset($pessoa);
    }
}
    ?>
  </body>
</html>
