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
<<<<<<< HEAD
    }
    private function insercao($nome, $idade, $email, $senha){
=======
        // Selecao dos dados para checagem se o email que foi inserido já consta no banco de dados
>>>>>>> a9193ade63a2f3622100401ad3e650dd75f0b3f0
        $sql = "SELECT email FROM participante WHERE email = '$email'";
        // Chamada do metodo da classe Conexao, getConnect que retorna o objeto conexao criado via MYSQLI
        $result = $this->connect->getConnection()->query($sql);
        // Verificando se o e-mail já está cadastrado
        // Se retornar alguma informacao pelo resultado, o email constará cadastrado
        if($result->num_rows > 0) {
            echo "Email já cadastrado";
<<<<<<< HEAD
            
        } else {
=======
        // Se retornar 0, a condição vai chamar uma query INSERT para colocar as informacoes do novo cadastro no banco de dados
        }else{
>>>>>>> a9193ade63a2f3622100401ad3e650dd75f0b3f0
            $insert = "INSERT INTO participante(nome, email, senha, idade) VALUES('$nome', '$email', '$senha', '$idade')";
            if($this->connect->getConnection()->query($insert) === TRUE){
                echo "Dados inseridos com sucesso";
            }else{
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
