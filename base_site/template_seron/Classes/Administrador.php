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
    public function aprovaColaborador($id_colaborador){
        $query = "UPDATE colaborador SET aprovacao = 'Aprovado' WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('i', $id_colaborador);
        $smtm->execute();
        $smtm->close();


    }
    public function recusaColaborador($id_colaborador){
        $query = "UPDATE colaborador SET aprovacao = 'Pendente' WHERE id = ?";
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('i', $id_colaborador);
        $smtm->execute();
        $smtm->close();

    }
    public function loginAdm($name, $senha){
        $result = $this->selectAdm($name, $senha);

        if($result->num_rows > 0){
            session_start();
            $_SESSION['adm'] = true;
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['user'] = $row['nome'];
            header('Location: adm.php');
        else{
            header('Location: index.php');
        }

    }
    private function selectAdm($name, $senha){
        $query = "SELECT nome, senha FROM administrador WHERE nome = ? AND senha = ?"; 
        $smtm = $this->connect->getConnection()->prepare($query);
        $smtm->bind_param('ss', $name, $senha);
        $smtm->execute();
        $result = $smtm->get_result();
        $smtm->close();
        return $result;

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
