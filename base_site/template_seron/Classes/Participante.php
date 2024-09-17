<?php
require_once('Pessoa.php');
require_once('Conexao.php');


class Participante extends Pessoa {
    private $idade;
    private $connect;
    function __construct(){
        $this->connect = new Conexao();
        
    }
    private function sanitizar($nome, $idade, $email, $senha){
        // Sanitizacao dos dados para dificultar SQL Injection
        $email = mysqli_real_escape_string($this->connect->getConnection(), $email);
        $senha = mysqli_real_escape_string($this->connect->getConnection(), $senha);
        $nome = mysqli_real_escape_string($this->connect->getConnection(), $nome);
        $idade = mysqli_real_escape_string($this->connect->getConnection(), $idade);


    }
    protected function selectEmail($email){
        // Selecao dos dados para checagem se o email que foi inserido já consta no banco de dados
        $sql = "SELECT email FROM participante WHERE email = ?";
        // Chamada do metodo da classe Conexao, getConnect que retorna o objeto conexao criado via MYSQLI
        $stmt = $this->connect->getConnection()->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
        $stmt->close();
         
        
        
    }
    private function insercao($nome, $idade, $email, $senha){
        $result = $this->selectEmail($email);
        // Verificando se o e-mail já está cadastrado
        // Se retornar alguma informacao pelo resultado, o email constará cadastrado
        if($result->num_rows > 0) {
            echo '<script>
            alert("Email já cadastrado!");
            window.location.href = "cadastro_participante2.php";
            </script>';
        }else{
            $insert = "INSERT INTO participante(nome, email, senha, nasc) VALUES(?,?,?,?)";
            $stmt = $this->connect->getConnection()->prepare($insert);
            $stmt->bind_param("ssss", $nome, $email, $senha, $idade);
            $stmt->execute();
            

            if($stmt){
                echo '<script>
                alert("Dados inseridos com sucesso!");
                window.location.href = "login2.php";
                </script>';
            }else{
                echo "Error: " . $insert . "<br>" . $this->connect->getConnection()->error;
            }
            $stmt->close();
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
    private function sanitizarLogin($email, $senha){
        $email = mysqli_real_escape_string($this->connect->getConnection(), $email);
        $senha = mysqli_real_escape_string($this->connect->getConnection(), $senha);
        
        return array($email, $senha);
    }
    private function selectLogin($email){
        
        
        // Consultar o banco de dados para encontrar o registro correspondente ao email e à senha
        $sql = "SELECT * FROM participante WHERE email= ?";
        $stmt = $this->connect->getConnection()->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
        $stmt->close();
       
    }
    public function login($email, $senha) {
        // Sanitizando os dados inserios
        list($email, $senha) = $this->sanitizarLogin($email, $senha);
        
        //Select no banco de dados para procurar a coluna
        $result = $this->selectLogin($email);
    
        // Verificar se o registro foi encontrado
        if ($result->num_rows > 0) {
            
            // Inicializar a sessão e armazenar o id do usuário na variável $_SESSION
            
            $row = $result->fetch_assoc();
            $hash = $row['senha'];
            if($this->comparaSenhaBanco($senha, $hash) === TRUE){
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['user'] = $row['nome'];
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['colaborador'] = FALSE;
                $_SESSION['adm'] = FALSE;
                echo '<script>
                alert("Login realizado com sucesso!");
                window.location.href = "index.php";
                </script>';
            }else{
                return "Email ou senha incorretos";
                session_start();
                $_SESSION['loggedin'] = FALSE;
                $_SESSION['colaborador'] = FALSE;
            }
            
        } else {
            return "Email ou senha incorretos";
        }
    }
    public function setIdade($idade){
        $this->idade = $idade;
    }
    public function getIdade(){
        return $this->idade;
    }
    private function updateNome($session_id, $nome){
        $query = "UPDATE participante SET nome = ? WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('si', $nome, $session_id);
        $smtm->execute();
        $smtm->close();


    }
    private function updateEmail($session_id, $email){
        $query = "UPDATE participante SET email = ? WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('si', $email, $session_id);
        $smtm->execute();
        $smtm->close();
    }
    private function updateIdade($session_id, $idade){
        $query = "UPDATE participante SET nasc = ? WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('si', $idade, $session_id);
        $smtm->execute();
    }
    public function update($session_id, $nome, $email, $data_nascimento){
        $result = $this->selectParticipante($session_id);

        if($result->num_rows  == 1){
            $this->updateNome($session_id, $nome);
            $this->updateEmail($session_id, $email);
            $this->updateIdade($session_id, $data_nascimento);
            echo '<script>
            alert("Dados alterados com sucesso!");
            window.location.href = "updatePerfilP.php";
            </script>';
        }else{
            echo '<script>
            alert("Dados não encontrados!");
            window.location.href = "updatePerfilP.php";
            </script>';    
    }
    }
    public function delete($session_id){
        $query = "DELETE FROM participante WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('i', $session_id);
        $smtm->execute();
        $smtm->close();
    }
    private function selectParticipante($session_id){
        $query = "SELECT * FROM participante WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('i', $session_id);
        $smtm->execute();
        $result = $smtm->get_result();
        return $result;
        $smtm->close();

    }
    public function getParticipante($session_id){
        $result = $this->selectParticipante($session_id);
        while($row = $result->fetch_assoc()){
            $participante = new Participante;
            $participante->setId($row['id']);
            $participante->setNome($row['nome']);
            $participante->setEmail($row['email']);
            $participante->setIdade($row['nasc']);
            
           
            

        return $participante;
    }
    }

    // Destruindo o objeto e fechando a conexao com o banco de dados
    public function __destruct(){
        $this->connect->closeConnection();
    }
    
}


?>
