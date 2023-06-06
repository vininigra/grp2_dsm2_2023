<?php
session_start();
// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])) {
     $status = "Logado";
     $sessao_id = $_SESSION['id'];
} else {
    header('location: index.php');
}

require_once("Classes/evento.php");
// Verifica se o ID do evento foi fornecido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_evento = $_POST['id'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $local = $_POST['local'];
    $tipo_esporte = $_POST['tipo_esporte'];
    $faixa_etaria = $_POST['faixa_etaria'];

    // Instancia o objeto evento
    $evento = new Evento();
    // Chamada do metodo update
    $evento->update($data, $hora, $local, $tipo_esporte, $faixa_etaria, $session_id);
    // Fechando conexao com o banco de dados
    unset($evento);

    header('location: lista_evento.php');
} else {
    echo "ID do evento não fornecido.";
}

?>