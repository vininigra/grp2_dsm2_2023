<?php
require_once('Conexao.php');
require_once('Pessoa.php');

class Colaborador extends Pessoa{
    private $cpf, $senha,$aprovacao,$connect;
    // Instancia um objeto Colaborador conectando ao banco de dados
    function __construct(){
        $this->connect = new Conexao();
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
    public function setAprovacao($aprovacao){
        $this->aprovacao = $aprovacao;
    }
    public function getAprovacao(){
        return $this->aprovacao;
    }
    
    public function setCPF($cpf){
        $this->cpf = $cpf;

    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getCPF(){
        return $this->cpf;
    }
    public function getSenha(){
        return $this->senha;
    }



    private function insercao($nome, $cpf, $email, $senha){
        $result = $this->selectEmail($email);
        // Verificando se o e-mail já está cadastrado
        // Se retornar alguma informacao pelo resultado, o email constará cadastrado
        if($result->num_rows > 0) {
            echo "Email já cadastrado";
        // Se retornar 0, a condição vai chamar uma query INSERT para colocar as informacoes do novo cadastro no banco de dados
        }else{
            $insert = "INSERT INTO colaborador(nome, cpf, email, senha, aprovacao) VALUES('$nome', $cpf, '$email', '$senha','Pendente')";
            if($this->connect->getConnection()->query($insert) === TRUE){
            echo '<script>
            alert("Dados inseridos com sucesso!");
            window.location.href = "login2.php";
            </script>';
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
    private function sanitizarLogin($email, $senha){
        $email = mysqli_real_escape_string($this->connect->getConnection(), $email);
        $senha = mysqli_real_escape_string($this->connect->getConnection(), $senha);
        
        return array($email, $senha);
    }
    private function selectLogin($email){
        
        
        // Consultar o banco de dados para encontrar o registro correspondente ao email e à senha
        $sql = "SELECT * FROM colaborador WHERE email='$email'";
        $result = $this->connect->getConnection()->query($sql);
        return $result;
    }
    public function login($email, $senha) {
        // Sanitizando os dados inserios
        list($email, $senha) = $this->sanitizarLogin($email, $senha);
        
        //Select no banco de dados para procurar a coluna
        $result = $this->selectLogin($email);
    
        // Verificar se o registro foi encontrado
        if ($result->num_rows > 0) {
            
            // Inicializar a sessão e armazenar o id do usuário na variável $_SESSION
            session_start();
            $row = $result->fetch_assoc();
            $hash = $row['senha'];
            if($this->comparaSenhaBanco($senha, $hash) === TRUE){
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['nome'];
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['colaborador'] = TRUE;
                $_SESSION['adm'] = FALSE;
                echo "Login realizado com sucesso!";
                header('location:index.php');
            }else{
                return "Email ou senha incorretos";
            }
            
        } else {
            return "Email ou senha incorretos";
        }
    }
     // Destruindo o objeto e fechando a conexao com o banco de dados
    public function __destruct(){
        $this->connect->closeConnection();
    }

}




?>
