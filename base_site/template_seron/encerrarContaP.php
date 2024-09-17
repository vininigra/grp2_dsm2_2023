<?php
session_start();


include_once "Classes/Participante.php";

// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])) {
    $status = "Logado";
    $session_id = $_SESSION['id'];
} else {
    header('location: index.php');
    exit(); // Encerra o script para evitar a execução desnecessária de código
}

$participante = new Participante();

// Verifica se o formulário foi enviado

if (isset($_GET['id'])){
    $participante->delete($session_id);
    echo '<script>alert("Excluido com sucesso!");</script>';
    $participante->logout();
    unset($participante);
}

?>