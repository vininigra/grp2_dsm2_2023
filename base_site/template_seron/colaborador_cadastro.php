<?php

require_once('Classes/Colaborador.php');
// Backend do cadastro de usuários do HTML

// Realizando a checagem do método de requisicao
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    
    

    $colaborador = new Colaborador();
    //Declarando as variaveis recebidas via POST
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $confirmasenha =$_POST['confirmasenha'];
    //Realizando as verificacoes das variaveis
    $colaborador->verificaNome($nome);
    $colaborador->verificaEmail($email);
    $colaborador->comparaSenha($senha,$confirmasenha);

    

    // Se todos os campos foram preenchidos corretamente, cadastra o participante
    $colaborador->cadastrar($nome, $cpf, $email, $senha);

    // Destroi o objeto participante e fecha a conexao com o banco de dados
    unset($colaborador);
}

?>
