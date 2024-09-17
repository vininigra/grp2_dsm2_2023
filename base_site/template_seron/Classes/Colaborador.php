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
        $sql = "SELECT email FROM colaborador WHERE email = ?";
        // Realizando prepared statments
        $smtm = $this->connect->getConnection()->prepare($sql);
        $smtm->bind_param('s', $email);
        $smtm->execute();
        $result = $smtm->get_result();
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
            $insert = "INSERT INTO colaborador(nome, cpf, email, senha, aprovacao) VALUES(?,?,?,?,'Pendente')";
            $smtm = $this->connect->getConnection()->prepare($insert);
            $smtm->bind_param('ssss', $nome, $cpf, $email, $senha);
            $smtm->execute();
            
            if($smtm){
            echo '<script>
            alert("Dados inseridos com sucesso!");
            window.location.href = "login2.php";
            </script>';
            }else{
                echo "Error: " . $insert . "<br>" . $this->connect->getConnection()->error;
            }
            $smtm->close();
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
        $sql = "SELECT * FROM colaborador WHERE email= ? ";
        // Realizando prepared statments
        $smtm = $this->connect->getConnection()->prepare($sql);
        $smtm->bind_param('s', $email);
        $smtm->execute();
        $result = $smtm->get_result();
        return $result;
        $smtm->close();
        
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
                $_SESSION['aprovacao'] = $row['aprovacao'];
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
    private function selectColaborador($session_id){
        $query = "SELECT * FROM colaborador WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('i', $session_id);
        $smtm->execute();
        $result = $smtm->get_result();
        return $result;
        $smtm->close();

    }
    private function updateNome($nome, $session_id){
        $query = "UPDATE colaborador SET nome = ? WHERE id = ?"; 
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('si', $nome, $session_id);
        $smtm->execute();
        $smtm->close();
    }
    private function updateEmail($email, $session_id){
        $query = "UPDATE colaborador SET email = ? WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('si', $email, $session_id);
        $smtm->execute();
        $smtm->close();
    }
    private function updateCPF($cpf, $session_id){
        $query = "UPDATE colaborador SET cpf = ? WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('si', $cpf, $session_id);
        $smtm->execute();
        $smtm->close();

    }
    public function update($session_id, $nome, $email, $cpf){
        $result = $this->selectColaborador($session_id);

        if($result->num_rows > 0){
            $this->updateNome($nome, $session_id);
            $this->updateEmail($email, $session_id);
            $this->updateCPF($cpf, $session_id);
            echo '<script>
            alert("Dados alterados com sucesso!");
            window.location.href = "updatePerfilC.php";
            </script>';
        }else{
            echo '<script>
            alert("Dados não encontrados!");
            window.location.href = "pdatePerfilC.php";
            </script>';    
    }
    }
    public function getColaborador($session_id){
        $result = $this->selectColaborador($session_id);
        while($row = $result->fetch_assoc()){
            $colaborador = new Colaborador;
            $colaborador->setId($row['id']);
            $colaborador->setNome($row['nome']);
            $colaborador->setEmail($row['email']);
            $colaborador->setCPF($row['cpf']);
            $colaborador->setSenha($row['senha']);
            $colaborador->setAprovacao($row['aprovacao']);
            

        return $colaborador;
    }
    }
    public function delete($session_id){
        $query = "DELETE FROM colaborador WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('i', $session_id);
        $smtm->execute();
        $smtm->close();
    }
     // Destruindo o objeto e fechando a conexao com o banco de dados
    public function __destruct(){
        $this->connect->closeConnection();
    }

}




?>
