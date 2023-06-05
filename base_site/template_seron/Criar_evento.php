<?php
    include('session.php');
    include_once "Classes/evento.php";
   

    //instancia as classes
    
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        if (isset($_POST['cadastrar'])) {
            // Criando variáveis para receber as informações do formulário
            $data = $_POST['data'];
            $hora = $_POST['hora'];
            $local = $_POST['local'];
            $tipo_esporte = $_POST['tipo_esporte'];
            $faixa_etaria = $_POST['faixa_etaria'];
    
            // Instanciando objeto evento e chamando o método para criar o evento
            $evento = new Evento();
            $evento->createEvento($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id);
        }
    }
  
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Criar Evento</title>
    <style>
        .menu,
        thead {
            background-color: #bbb !important;
        }

        .row {
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light menu">
        <div class="container">
            <a class="navbar-brand" href="#">
                Cadastro de Eventos
            </a>
        </div>
    </nav>
    <div class="container">
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <label>Data</label>
                    <input type="date" name="data" value="" autofocus class="form-control" require />
                </div>
                <div class="col-md-5">
                    <label>Hora</label>
                    <input type="time" name="hora" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>Local</label>
                    <input type="text" name="local" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>Esporte</label>
                    <input type="text" name="tipo_esporte" value="" class="form-control" require />
                </div>
                <div class="col-md-2">
                    <label>Idade</label>
                    <input type="number" name="faixa_etaria" value="" class="form-control" require />
                </div>
                <div class="col-md-2">    
                    <br>
                    <button class="btn btn-primary" type="submit" name="cadastrar">Cadastrar</button>
                    <br>
                    <a class="btn btn-primary" href="lista_evento.php">Listar</a>
                </div>
            </div>
        </form>
        

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>