<?php
require_once('Pessoa.php');
require_once('Conexao.php');


class Participante extends Pessoa {
    private $idade, $senha;
    private $connect;
    function __construct($servername, $username, $password, $dbname){
        $this->connect = $connect = new Conexao($servername, $username, $password, $dbname);
    }
    public function cadastrar($nome, $idade, $email, $senha) {
        
        
        // Sanitizacao dos dados para dificultar SQL Injection
        $email = mysqli_real_escape_string($this->connect->getConnection(), $email);
        $senha = mysqli_real_escape_string($this->connect->getConnection(), $senha);
        $nome = mysqli_real_escape_string($this->connect->getConnection(), $nome);
        $idade = mysqli_real_escape_string($this->connect->getConnection(), $idade);
        // Selecao dos dados para checagem se o email que foi inserido já consta no banco de dados
        $sql = "SELECT email FROM participante WHERE email = '$email'";
        // Chamada do metodo da classe Conexao, getConnect que retorna o objeto conexao criado via MYSQLI
        $result = $this->connect->getConnection()->query($sql);
        // Verificando se o e-mail já está cadastrado
        // Se retornar alguma informacao pelo resultado, o email constará cadastrado
        if($result->num_rows > 0) {
            echo "Email já cadastrado";
        // Se retornar 0, a condição vai chamar uma query INSERT para colocar as informacoes do novo cadastro no banco de dados
        }else{
            $insert = "INSERT INTO participante(nome, email, senha, idade) VALUES('$nome', '$email', '$senha', '$idade')";
            if($this->connect->getConnection()->query($insert) === TRUE){
                echo "Dados inseridos com sucesso";
            }else{
                echo "Error: " . $insert . "<br>" . $this->connect->getConnection()->error;
            }
        }
    }

    public function login($email, $senha) {
        // TODO: Implementar a função login
    }
}


?>
