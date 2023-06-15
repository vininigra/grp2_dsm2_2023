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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editar'])) {
        // Criando variáveis para receber as informações do formulário
        
        $nome = $_POST['name'];
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];
        

        // Chamada do método update
        $participante->update($session_id, $nome, $email, $data_nascimento);
        
        // Redireciona para a página de listagem de eventos
        
        exit(); // Encerra o script para evitar a execução desnecessária de código
    }else{
        $participante->delete($session_id);
        echo '<script>alert("Excluido com sucesso!");</script>';
    }
}
?>