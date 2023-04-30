


<?php

require_once('Classes/Participante.php');
// Backend do cadastro de usuários do HTML


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo nome foi preenchido
    if (empty($_POST["name"])) {
        echo "O campo nome é obrigatório";
        exit;
    }
    
    // Verifica se o campo email foi preenchido e é um email válido
    if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo "O campo email é obrigatório e deve ser um email válido";
        exit;
    }
    
    // Verifica se o campo dt_nascimento foi preenchido e é uma data válida
    if (empty($_POST["dt_nascimento"]) || !strtotime($_POST["dt_nascimento"])) {
        echo "O campo data de nascimento é obrigatório e deve ser uma data válida";
        exit;
    }
    
    // Verifica se o campo senha foi preenchido
    if (empty($_POST["senha"])) {
        echo "O campo senha é obrigatório";
        exit;
    }
    
    // Se todos os campos foram preenchidos corretamente, cadastra o participante
    $participante = new Participante($servername, $username, $password, $dbname);
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $idade = $_POST['dt_nascimento'];
    $senha = $_POST['senha'];
    $participante->cadastrar($nome, $idade, $email, $senha);
}

?>
