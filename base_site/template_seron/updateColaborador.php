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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editar'])) {
        // Criando variáveis para receber as informações do formulário
        
        $nome = $_POST['name'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        

        // Chamada do método update
        $colaborador->update($session_id, $nome, $email, $cpf);
        
        // Redireciona para a página de listagem de eventos
        header('location: updatePerfilC.php');
        exit(); // Encerra o script para evitar a execução desnecessária de código
    }else{
        $colaborador->delete($session_id);
        echo '<script>alert("Excluido com sucesso!");</script>';
    }
}
?>