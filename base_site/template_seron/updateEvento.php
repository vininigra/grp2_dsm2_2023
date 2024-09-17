<?php
session_start();


include_once "Classes/evento.php";

// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])) {
    $status = "Logado";
    $session_id = $_SESSION['id'];
} else {
    header('location: index.php');
    exit(); // Encerra o script para evitar a execução desnecessária de código
}

$evento = new Evento();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editar'])) {
        // Criando variáveis para receber as informações do formulário
        $idEvento = $_POST['id'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $local = $_POST['local'];
        $tipoEsporte = $_POST['tipo_esporte'];
        $faixaEtaria = $_POST['faixa_etaria'];

        // Chamada do método update
        $evento->update($data, $hora, $local, $tipoEsporte, $faixaEtaria, $session_id, $idEvento);
        
        // Redireciona para a página de listagem de eventos
        header('location: lista_evento.php');
        exit(); // Encerra o script para evitar a execução desnecessária de código
    }
}
?>