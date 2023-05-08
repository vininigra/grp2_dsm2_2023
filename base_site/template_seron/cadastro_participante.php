<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Seron</title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/fontAwesome.css">
    <link rel="stylesheet" href="css/hero-slider.css">
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/style.css">

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <title>Cadastro</title>
</head>
<body>
<section class="banner banner-secondary" id="top" style="background-image: url(img/banner-image-3-1920x300.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="banner-caption">
                        <div class="line-dec"></div>
                        <h2>Cadastro</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class= "container">
        <div class= "row"></div>
            <div class= "col-md-12"></div>
                <form action = "participante_cadastro.php" method = "post" >
                    <label for="name">Nome Completo</label>
                    <input type = "text" id = "name" name = "name"><br><br>
                    <label for="email">Insira o seu e-mail</label>
                    <input type="text" id="email" name = "email"><br><br>
                    <label for="dt_nascimento">Insira a sua data de nascimento</label>
                    <input type="date" id ="dt_nascimento" name="dt_nascimento"><br><br>
            
                    <label for="senha">Insira sua Senha</label><br><br>
                    <input type="password" id="senha" name="senha"><br><br>
                    <label for="confirmaSenha">Confirme a senha</label><br><br>
                    <input type="password" id="confirmaSenha" name="confirmaSenha"><br><br>
                    <div class= "blue-button">
                        <input type = "submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>