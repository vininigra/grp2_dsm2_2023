<?php
    require_once('Conexao.php');
abstract class Pessoa{
    private $nome, $email,$senha;
     // Método para criptografar a senha
     protected function criptografarSenha($senha) {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        return $hash;
    }

    // Método para verificar se a senha está correta
    private function verificarSenha($senha, $senhaHash) {
        if (password_verify($senha, $senhaHash)) {
            return true;
        } else {
            return false;
        }
    }
    // Método que verifica se os campos senha e confirma senha estão correspondentes
    public function comparaSenha($senha,$confirmaSenha){
        if($senha != $confirmaSenha) {
            echo "<p style='color: red'>As senhas não conferem</p>";
            exit;
           }
        }
    // Verifica se o campo nome foi preenchido
    public function verificaNome($nome){
        if (empty($nome)) {
            echo "O campo nome é obrigatório";
            exit;
        }
    }
    // Verifica se o campo email foi preenchido e é um email válido
    public function verificaEmail($email){
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "O campo email é obrigatório e deve ser um email válido";
            exit;
    }
    }
    // Verifica se o campo dt_nascimento foi preenchido e é uma data válida
    public function verificaData($dt_nascimento){ 
        if (empty($dt_nascimento) || !strtotime($dt_nascimento)) {
            echo "O campo data de nascimento é obrigatório e deve ser uma data válida";
            exit;
    }
    }
    // Verifica se o campo senha foi preenchido
    public function validaSenha($senha){   
        if (empty($_POST["senha"])) {
            echo "O campo senha é obrigatório";
            exit;
    } 
    }
    private function sanitizarLogin($email, $senha){
        $email = mysqli_real_escape_string($this->connect->getConnection(), $email);
        $senha = mysqli_real_escape_string($this->connect->getConnection(), $senha);
        $senha = $this->criptografarSenha($senha);
    }
    private function selectLogin($email, $senha){
    // Consultar o banco de dados para encontrar o registro correspondente ao email e à senha
    $sql = "SELECT * FROM participante WHERE email='$email' AND senha='$senha'";
    $result = $this->connect->getConnection()->query($sql);
    return $result;
    }
    public function login($email, $senha) {
        // Sanitizando os dados inserios
        $this->sanitizarLogin($email, $senha);
        //Select no banco de dados para procurar a coluna
        $result = $this->selectLogin($email, $senha);

    // Verificar se o registro foi encontrado
    if ($result->num_rows > 0) {
        // Inicializar a sessão e armazenar o id do usuário na variável $_SESSION
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        echo "Login realizado com sucesso!";
    } else {
        echo "Email ou senha incorretos";
    }
    }

}




?>
