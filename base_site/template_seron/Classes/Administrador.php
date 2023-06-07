<?php
require_once('Pessoa.php');
require_once('Colaborador.php');
require_once('Conexao.php');

class Administrador extends Pessoa {
    private $nome;
    private $email;
    private $senha;
    private $connect;
    private $colaborador;
    public function __construct(){
        $this->connect = new Conexao();
        $this->colaborador = new Colaborador();
    }

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function aprovaColaborador(){
        

    }
    public function recusaColaborador(){

    }
    public function selectColaborador(){
        $this->selectColaboradorProcedure();
    }

    private function selectColaboradorProcedure(){
        $sql = "CALL SP_SELECTCOLABORADOR()";
        $smtm = $this->connect->prepare($sql);
        $smtm->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $rows;
        }
    }

    function __destruct(){
        $this->connect->closeConnection();
}
}

?>
