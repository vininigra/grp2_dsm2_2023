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
        
        try {
            $result = $this->selectColaboradorProcedure();
            
            $f_lista = array();
            while ($row = $result->fetch_assoc()) {
                $f_lista[] = $this->criaArray($row);
            }
            unset($evento);
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    
    private function selectColaboradorProcedure(){
        $sql = "CALL SP_SELECTCOLABORADOR()";
        $smtm = $this->connect->getConnection()->prepare($sql);
        $smtm->execute();
        $result = $smtm->get_result();
        
        return $result;
        
    }
    private function criaArray($row){
        $this->colaborador = new Colaborador();
        $this->colaborador->setId($row['id']);
        $this->colaborador->setNome($row['nome']);
        $this->colaborador->setCpf($row['cpf']);
        $this->colaborador->setEmail($row['email']);
        $this->colaborador->setSenha($row['senha']);
        $this->colaborador->setAprovacao($row['aprovacao']);
        
        return $this->colaborador;
        
    }

    function __destruct(){
        $this->connect->closeConnection();
}
}

?>
