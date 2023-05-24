<?php
require_once('Classes/evento.php');
require_once('Classes/Participante.php');
// Backend do cadastro de usuários do HTML

// Realizando a checagem do método de requisicao
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    
    
    $evento = new Evento();
    $participante = new Participante();
    //Declarando as variaveis recebidas via POST
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $idade = $_POST['dt_nascimento'];
    $senha = $_POST['senha'];
    $confirmasenha =$_POST['confirmaSenha'];
    //Realizando as verificacoes das variaveis
    $participante->verificaNome($nome);
    $participante->verificaEmail($email);
    $participante->verificaData($idade);
    $participante->comparaSenha($senha,$confirmasenha);

    

    // Se todos os campos foram preenchidos corretamente, cadastra o participante
    $participante->cadastrar($nome, $idade, $email, $senha);

    // Destroi o objeto participante e fecha a conexao com o banco de dados
    unset($participante);
}

?>
