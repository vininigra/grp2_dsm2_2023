<?php
require_once('Pessoa.php');
require_once('Conexao.php');

class Administrador extends Pessoa {
    private $nome;
    private $email;
    private $senha;
    private $connect;

    public function __construct(){
        $this->connect = new Conexao();

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
    private function selectColaboradorProcedure(){
        $sql = "CALL SP_SELECTCOLABORADOR()";
        $smtm = $this->connect->prepare($sql);
        $smtm->execute();
        $result = $smtm->fetchAll();
        $smtm->close();
        return $result;
    }
}

?>
