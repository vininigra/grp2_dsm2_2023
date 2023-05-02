<?php
require_once('Conexao.php');
require_once('Pessoa.php');

class Colaborador extends Pessoa{
    private $cpf, $senha,$connect;

    private function __construct($nome, $cpf, $email, $senha){
        $this->connect = $connect;
        $connect = new Conexao($servername, $username, $password, $dbname);
    }
    public function cadastrar(){


    }

}




?>
