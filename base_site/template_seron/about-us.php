<?php
session_start();

// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])){
    $status = "Logado";
    $colaborador = $_SESSION['colaborador'];
} else {
    $status = "Cadastre-se";
    
}

?>


<!DOCTYPE php>
<php>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sobre Nós</title>
        
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
      
    <section class="banner banner-secondary" id="top" style="background-image: url(img/banner_eventos.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="banner-caption">
                        <div class="line-dec"></div>
                        <h2>Sobre nós</h2>
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
                            <h4>Um pouco sobre a equipe</h4>
                            <p>Aenean hendrerit metus leo, quis viverra purus condimentum nec. Pellentesque a sem semper, lobortis mauris non, varius urna. Quisque sodales purus eu tellus fringilla.<br><br>Mauris sit amet quam congue, pulvinar urna et, congue diam. Suspendisse eu lorem massa. Integer sit amet posuere tellus, id efficitur leo. In hac habitasse platea dictumst. Vel sequi odit similique repudiandae ipsum iste, quidem tenetur id impedit, eaque et, aliquam quod.</p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure cupiditate id unde quis ut maxime, accusantium aperiam consectetur saepe delectus ducimus accusamus, ad doloremque ea. Quam, suscipit quidem perspiciatis asperiores, libero cum saepe hic pariatur eos deleniti illum minima minus.</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <img src="img/about-1-720x480.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section id="video-container">
            <div class="video-overlay"></div>
            <div class="video-content">
                <div class="inner">
                      <div class="section-heading">
                          <span>Lorem ipsum dolor.</span>
                          <h2>Vivamus nec vehicula felis</h2>
                      </div>
                      <!-- Modal button -->

                      <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1">
                                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi blanditiis, esse deserunt assumenda! Tempora nulla natus illum soluta quasi, nisi, in quaerat cumque corrupti ipsum impedit necessitatibus expedita minus harum, fuga id aperiam autem architecto odio. Perferendis eius possimus ex itaque tenetur saepe id quis dicta voluptas, corrupti sapiente hic!</p>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </section>

        <section class="popular-places" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <span>Equipe</span>
                            <h2>Time de desenvolvimento</h2>
                        </div>
                    </div> 
                </div> 

                <div class="owl-carousel owl-theme">
                    <div class="item popular-item">
                        <div class="thumb">
                            <div class="thumb-img">
                                <img src="img/carlao.png" alt="">
                            </div>
                            <div class="text-content">
                                <h4>Carlos Degasperi</h4>
                                <span>Data Engineer</span>
                            </div>
                            <div class="plus-button">
                                <a href="https://github.com/CarlosDegasperi"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="item popular-item">
                        <div class="thumb">
                            <div class="thumb-img">
                                <img src="img/guilherme.png" alt="">
                            </div>
                            <div class="text-content">
                                <h4>Guilherme Afonso</h4>
                                <span>Sênior back-end</span>
                            </div>
                            <div class="plus-button">
                                <a href="https://github.com/ParaQueNome"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="item popular-item">
                        <div class="thumb">
                            <div class="thumb-img">
                                <img src="img/matheus.png" alt="">
                            </div>
                            <div class="text-content">
                                <h4>Matheus Matias</h4>
                                <span>Project Manager/Front End</span>
                            </div>
                            <div class="plus-button">
                                <a href="https://github.com/matheusoms"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item popular-item">
                        <div class="thumb">
                            <div class="thumb-img">
                                <img src="img/vini.png" alt="">
                            </div>
                            <div class="text-content">
                                <h4>Vinicius Nigra</h4>
                                <span>Pleno Back end</span>
                            </div>
                            <div class="plus-button">
                                <a href="https://github.com/vininigra"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="item popular-item">
                        <div class="thumb">
                            <div class="thumb-img">
                                <img src="img/vitor.png" alt="">
                            </div>
                            <div class="text-content">
                                <h4>Vitor Carvalho</h4>
                                <span>Diagrams</span>
                            </div>
                            <div class="plus-button">
                                <a href="https://github.com/devvhitor"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
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