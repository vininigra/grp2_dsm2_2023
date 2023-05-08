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
        // Chamada do metodo da classe Conexao, getConnect que retorna o objeto conexao criado via MYSQLI
        $result = $this->connect->getConnection()->query($sql);
        // Verificando se o e-mail já está cadastrado
        // Se retornar alguma informacao pelo resultado, o email constará cadastrado
        if($result->num_rows > 0) {
            echo "Email já cadastrado";
        }else{
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

        //Criptografando a senha
        $hash = $this->criptografarSenha($senha);
        
        //Chamada da insercao de dados
        $this->insercao($nome, $idade, $email, $hash);
        
       
    }

    public function login($email, $senha) {
        // TODO: Implementar a função login
    }

    // Destruindo o objeto e fechando a conexao com o banco de dados
    public function __destruct(){
        $this->connect->closeConnection();
    }
}


?>
