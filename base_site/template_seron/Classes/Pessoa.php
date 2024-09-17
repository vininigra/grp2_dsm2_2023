<?php
    require_once('Conexao.php');
abstract class Pessoa{
    private $nome, $email,$senha, $id;
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
    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
    
    // Método que verifica se os campos senha e confirma senha estão correspondentes
    public function comparaSenha($senha,$confirmaSenha){
        if($senha != $confirmaSenha) {
            echo '<script>
            alert("As senhas não conferem!");
            window.location.href = "cadastro_colaborador2.php";
            </script>';
            exit;
           }
        }
    protected function comparaSenhaBanco($senha, $hash){
        if(password_verify($senha,$hash)){
            return true;
        }
    }
    // Verifica se o campo nome foi preenchido
    public function verificaNome($nome){
        if (empty($nome)) {
            echo '<script>
            alert("O campo nome é obrigatário!");
            window.location.href = "login2.php";
            </script>';
            exit;
        }
    }
    // Verifica se o campo email foi preenchido e é um email válido
    public function verificaEmail($email){
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>
            alert("O campo e-mail é obrigatório e deve inserir um e-mail válido!");
            window.location.href = "login2.php";
            </script>';            exit;
    }
    }
    // Verifica se o campo dt_nascimento foi preenchido e é uma data válida
    public function verificaData($dt_nascimento){ 
        if (empty($dt_nascimento) || !strtotime($dt_nascimento)) {
            echo '<script>
            alert("O campo data de nascimento é obrigatório e deve ser uma data válida"!");
            window.location.href = "login2.php";
            </script>';
            exit;
    }
    }
    
    
    public function validaSenha($senha){   
        if (empty($_POST["senha"])) {
            echo '<script>
            alert("O campo senha é obrigatório!");
            window.location.href = "login2.php";
            </script>';
            exit;
    } 
    }
    public function logout(){
        //if(isset($_SESSION['loggedin'])){
            //$_SESSION['loggedin'] == FALSE;
            session_destroy();
            
        //}
    }
    

}




?>
