<?php
require_once('Conexao.php');
require_once('Pessoa.php');

class Colaborador extends Pessoa{
    private $cpf, $senha,$connect;
    // Instancia um objeto Colaborador conectando ao banco de dados
    function __construct($servername, $username, $password, $dbname){
        $this->connect = new Conexao($servername, $username, $password, $dbname);
    }
    // Sanitizacao dos dados para dificultar SQL Injection
    private function sanitizacao($nome, $cpf, $email, $senha){
         $email = mysqli_real_escape_string($this->connect->getConnection(), $email);
         $senha = mysqli_real_escape_string($this->connect->getConnection(), $senha);
         $nome = mysqli_real_escape_string($this->connect->getConnection(), $nome);
         $cpf = mysqli_real_escape_string($this->connect->getConnection(), $cpf);
    }
    protected function selectEmail($email){
        // Selecao dos dados para checagem se o email que foi inserido já consta no banco de dados
        $sql = "SELECT email FROM colaborador WHERE email = '$email'";
         // Chamada do metodo da classe Conexao, getConnect que retorna o objeto conexao criado via MYSQLI
        $result = $this->connect->getConnection()->query($sql);
        return $result;
        
    }
    private function insercao($nome, $cpf, $email, $senha){
        $result = $this->selectEmail($email);
        // Verificando se o e-mail já está cadastrado
        // Se retornar alguma informacao pelo resultado, o email constará cadastrado
        if($result->num_rows > 0) {
            echo "Email já cadastrado";
        // Se retornar 0, a condição vai chamar uma query INSERT para colocar as informacoes do novo cadastro no banco de dados
        }else{
            $insert = "INSERT INTO colaborador(nome, cpf, email, senha) VALUES('$nome', $cpf, '$email', '$senha')";
            if($this->connect->getConnection()->query($insert) === TRUE){
                echo "Dados inseridos com sucesso";
            }else{
                echo "Error: " . $insert . "<br>" . $this->connect->getConnection()->error;
            }
        }
    }
    public function cadastrar($nome, $cpf, $email, $senha){
         // Chamada do metodo para a sanitizacão
        $this->sanitizacao($nome, $cpf, $email, $senha);

        //Criptografando a senha
        $hash = $this->criptografarSenha($senha);
        
        //Chamada da insercao de dados
        $this->insercao($nome, $cpf, $email, $hash);

    }
     // Destruindo o objeto e fechando a conexao com o banco de dados
    public function __destruct(){
        $this->connect->closeConnection();
    }

}




?>
