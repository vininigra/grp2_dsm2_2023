<?php
require_once('Pessoa.php');
require_once('Conexao.php');
class Participante extends Pessoa{
    private $idade, $senha;
    
    function __construct(){
        $connect = new Conexao;
        

    }
    public function cadastrar($nome, $idade, $email, $senha){
        $sql = "SELECT email FROM participante";
        if($email == $sql){
            echo "Email já cadastrado";
        }else{
            $insert = "INSERT INTO participante(nome,email,senha,idade) VALUES($nome,$email,$senha,$idade)";
            if($connect->query($insert) === TRUE) {
                echo "Dados inseridos com sucesso";
            } else {
                echo "Error: " . $insert . "<br>" . $connect->error;
            }
        }
        
    }

    public function login($email,$senha){

    }
}



?>
