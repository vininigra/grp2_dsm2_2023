<?php
session_start();
// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])) {
    $status = "Logado";
    $sessao_id = $_SESSION['id'];
} else {
    header('location: index.php');
}
include_once "Classes/evento.php";

// Instancia a classe Evento
$evento = new Evento();

// Verifica se o formulário foi enviado

    if (isset($_POST['Editar'])) {
        // Criando variáveis para receber as informações do formulário
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $local = $_POST['local'];
        $tipo_esporte = $_POST['tipo_esporte'];
        $faixa_etaria = $_POST['faixa_etaria'];

        
        
        
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
                Lista de Eventos
            </a>
        </div>
    </nav>
    <div class="container">

        <hr>
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Local</th>
                        <th>Esporte</th>
                        <th>Idade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($evento->read($sessao_id) as $eventoItem) : ?>
                        <tr>
                            <td><?= $eventoItem->getId() ?></td>
                            <td><?= $eventoItem->getData() ?></td>
                            <td><?= $eventoItem->getHora() ?></td>
                            <td><?= $eventoItem->getLocal() ?></td>
                            <td><?= $eventoItem->getTipo_esporte() ?></td>
                            <td><?= $eventoItem->getFaixa_etaria() ?></td>
                            <td class="text-center">
                                <button class="btn  btn-warning btn-sm" data-toggle="modal" data-target="#editar<?= $eventoItem->getId() ?>">
                                    Editar
                                </button>
                                <a href="deleteEvento.php?id=<?= $eventoItem->getId() ?>" >
                                    <button class="btn btn-danger btn-sm" type="button">Excluir</button>
                                </a>

                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editar<?= $eventoItem->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="Classes/evento.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>Data</label>
                                                    <input type="date" name="data" value="<?= $eventoItem->getData() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-7">
                                                    <label>Hora</label>
                                                    <input type="time" name="hora" value="<?= $eventoItem->getHora() ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Local</label>
                                                    <input type="text" name="local" value="<?= $eventoItem->getLocal() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Esporte</label>
                                                    <input type="text" name="tipo_esporte" value="<?= $eventoItem->getTipo_esporte() ?>" class="form-control" required />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Idade</label>
                                                    <input type="number" name="faixa_etaria" value="<?= $eventoItem->getFaixa_etaria() ?>" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="id" value="<?= $eventoItem->getId() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Editar</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary" href="criar_evento.php">Voltar</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
