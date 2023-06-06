<?php
include('session.php');

require_once("Classes/evento.php");
// Verifica se o ID do evento foi fornecido
if (isset($_GET['id'])) {
    $id_evento = $_GET['id'];

    // Instancia o objeto evento
    $evento = new Evento();
    $evento->delete($id_evento, $session_id);
    unset($evento);

    header('location: lista_evento.php');
} else {
    echo "ID do evento não fornecido.";
}

?>