<?php
include('session1.php');

?>
<!DOCTYPE html>
<html>
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
    </head>

<body>
 
    <div class="wrap">
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <button id="primary-nav-button" type="button">Menu</button>
                        <a href="index.php"><div class="logo">
                            <img src="img/logo2.png" alt="Venue Logo" width="220" height="100">
                        </div></a>
                        <nav id="primary-nav" class="dropdown cf">
                            <ul class="dropdown menu">
                                <li class='active'><a href="index.php">Página Inicial</a></li>

                                <li><a href="eventos.php">Eventos</a></li>

                                <li><a href="about-us.php">Sobre Nós</a></li>
                                
                                <li>
                                    <?php if($status == 'Logado'){
                                        
                                       echo '<a> Logado:' .  $_SESSION['user'] . ' </a>';
                                    }else{
                                        echo '<a href="cadastro.php">'  . $status . '</a>';
                                    } ?>
                                </li>
                                <?php
                                    if($status == 'Logado'){
                                        if($colaborador == TRUE) 
                                            echo '<li> <a href="Criar_evento.php"> Evento </a> </li>';
                                            echo '<li> <a href="logout.php"> Sair </a> </li>';
                                    }         
                                ?>
                                
                            </ul>
                        </nav><!-- / #primary-nav -->
                    </div>
                </div>
            </div>
        </header>
    </div>
      
    <section class="banner" id="top" style="background-image: url(img/esportes.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="banner-caption">
                        <div class="line-dec"></div>
                        <h2>Seja bem-vindo ao Seron.</h2>
                        <div class="blue-button">
                            <a href="cadastro.php">Cadastre-se</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="our-services">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="left-content">
                            <br>
                            <h4>Sobre Nós</h4>
                                <p>O Seron é uma plataforma voltada ao desenvolvimento esportivo de jovens e adultos de Araras e região.</p>
                            <div class="blue-button">
                                <a href="about-us.php">Saiba Mais</a>
                            </div>

                            <br>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="img/about_us.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-places">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <span>Últimos posts</span>
                            <h2>Veja abaixo as principais oficinas ativas:</h2>
                        </div>
                    </div> 
                </div> 

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="img/basquete.jpg" alt="">
                                </div>

                                <div class="overlay-content">
                                 <strong title="Author"><i class="fa fa-user"></i> FHO</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <!-- <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong> -->
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Oficina de Basquete</h4>

                                <p>Se inscreva na oficina de basquete ministrada pelo instrutor Marcos Filho.</p>

                                <div class="text-button">
                                    <a href="cadastro.php">Inscrever-se</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="img/volei.jpg" alt="">
                                </div>

                                <div class="overlay-content">
                                 <strong title="Author"><i class="fa fa-user"></i> FHO</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <!-- <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong> -->
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Oficina de Vôlei</h4>

                                <p>Se inscreva na oficina de volei ministrada pelo instrutor José Silva.</p>

                                <div class="text-button">
                                    <a href="cadastro.php">Inscrever-se</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="img/futebol.jpg" alt="">
                                </div>

                                <div class="overlay-content">
                                 <strong title="Author"><i class="fa fa-user"></i> Ginasio Nelson Ruegger</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <!-- <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong> -->
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Oficina de Futebol</h4>

                                <p>Se inscreva na oficina de futebol ministrada pela instrutora Beatriz Macedo.</p>

                                <div class="text-button">
                                    <a href="cadastro.php">Inscrever-se</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="img/golf.png" alt="">
                                </div>

                                <div class="overlay-content">
                                 <strong title="Author"><i class="fa fa-user"></i> FHO</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <!-- <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong> -->
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Oficina de Golf</h4>

                                <p>Se inscreva na oficina de golf ministrada pelo instrutor Jean Paul.</p>

                                <div class="text-button">
                                    <a href="cadastro.php">Inscrever-se</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="img/handbol.png" alt="">
                                </div>

                                <div class="overlay-content">
                                 <strong title="Author"><i class="fa fa-user"></i> FHO</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <!-- <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong> -->
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Oficina de Handbol</h4>

                                <p>Se inscreva na oficina de handbol ministrada pela instrutora Jenfier Reis.</p>

                                <div class="text-button">
                                    <a href="cadastro.php">Inscrever-se</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="img/natacao.png" alt="">
                                </div>

                                <div class="overlay-content">
                                 <strong title="Author"><i class="fa fa-user"></i> Ginasio Nelson Ruegger</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <strong title="Posted on"><i class="fa fa-calendar"></i> 12/06/2020 10:30</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                 <!-- <strong title="Views"><i class="fa fa-map-marker"></i> 115</strong> -->
                                </div>
                            </div>

                            <div class="down-content">
                                <h4>Oficina de Natacao</h4>

                                <p>Se inscreva na oficina de futebol ministrada pela instrutora Beatriz Macedo.</p>

                                <div class="text-button">
                                    <a href="cadastro.php">Inscrever-se</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="video-container">
            <div class="video-overlay"></div>
            <div class="video-content">
                <div class="inner">
                      <div class="section-heading">
                          <span>Nos contate</span>
                          <h2>Venha conhecer a experiência de ser Seron</h2>
                        </div>

                      <div class="blue-button">
                        <a href="contact.php">Fale Conosco</a>
                      </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="about-veno">
                        <div class="logo">
                            <img src="img/logo2.png" alt="Venue Logo" width="200" height="100">
                        </div>
                        <p>Nosso objetivo é incentivar o antii-sedentarismo, visando a saúde e bem estar da população mais jovem.</p>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="useful-links">
                        <div class="footer-heading">
                            <h4>Links rápidos</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="index.php"><i class="fa fa-stop"></i>Página Inicial</a></li>
                                    <li><a href="about.php"><i class="fa fa-stop"></i>Sobre Nós</a></li>
                                    <li><a href="contact.php"><i class="fa fa-stop"></i>Fale Conosco</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li><a href="team.php"><i class="fa fa-stop"></i>Autores</a></li>
                                    <li><a href="blog.php"><i class="fa fa-stop"></i>Eventos</a></li>
                                    <li><a href="terms.php"><i class="fa fa-stop"></i>Termos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="footer-heading">
                            <h4>Informações de contato</h4>
                        </div>
                        <p><i class="fa fa-map-marker"></i> Fatec Araras, SP</p>
                        <ul>
                            <li><span>Phone:</span><a href="#">+55 19 99999-9999</a></li>
                            <li><span>Email:</span><a href="#">sac@seron.com.br</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="sub-footer">
        <p>Copyright © 2023 SERON - Conheça mais sobre: <a href="https://periodic-word-7f5.notion.site/SERON-4ab5a4c87629464c9faf2b9417301042">Seron.com</a></p>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/vendor/bootstrap.min.js"></script>
    
    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>
</html>