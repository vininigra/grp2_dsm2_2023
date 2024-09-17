<?php
session_start();


include_once "Classes/Colaborador.php";

// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])) {
    $status = "Logado";
    $session_id = $_SESSION['id'];
} else {
    header('location: index.php');
    exit(); // Encerra o script para evitar a execução desnecessária de código
}

$colaborador = new Colaborador();

// Verifica se o formulário foi enviado

if (isset($_GET['id'])){
    $colaborador->delete($session_id);
    echo '<script>alert("Excluido com sucesso!");</script>';
    $colaborador->logout();
    unset($colaborador);
}

?>