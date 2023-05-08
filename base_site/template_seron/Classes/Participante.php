<?php
require_once('Pessoa.php');
require_once('Conexao.php');


class Participante extends Pessoa {
    private $idade;
    private $connect;
    function __construct($servername, $username, $password, $dbname){
        $this->connect = new Conexao($servername, $username, $password, $dbname);
        
    }
    private function sanitizar($nome, $idade, $email, $senha){
        // Sanitizacao dos dados para dificultar SQL Injection
        $email = mysqli_real_escape_string($this->connect->getConnection(), $email);
        $senha = mysqli_real_escape_string($this->connect->getConnection(), $senha);
        $nome = mysqli_real_escape_string($this->connect->getConnection(), $nome);
        $idade = mysqli_real_escape_string($this->connect->getConnection(), $idade);
    }
    private function insercao($nome, $idade, $email, $senha){
        $sql = "SELECT email FROM participante WHERE email = '$email'";
        $result = $this->connect->getConnection()->query($sql);
        if ($result->num_rows > 0) {
            echo "Email já cadastrado";
            
        } else {
            $insert = "INSERT INTO participante(nome, email, senha, idade) VALUES('$nome', '$email', '$senha', '$idade')";
            if ($this->connect->getConnection()->query($insert) === TRUE) {
                echo "Dados inseridos com sucesso";
            } else {
                echo "Error: " . $insert . "<br>" . $this->connect->getConnection()->error;
            }
            
        }
    }
    public function cadastrar($nome, $idade, $email, $senha) {
        // Chamada do metodo para a sanitizacão
        $this->sanitizar($nome, $idade, $email, $senha);
        
        //Chamada da insercao de dados
        $this->insercao($nome, $idade, $email, $senha);
        
       
    }

    public function login($email, $senha) {
        // TODO: Implementar a função login
    }


    public function __destruct(){
        $this->connect->closeConnection();
    }
}


?>
