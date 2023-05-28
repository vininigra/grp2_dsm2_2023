<?php
require_once('Conexao.php');

class Evento{
    
    private $data;
    private $hora;
    private $local;
    private $tipo_esporte;
    private $faixa_etaria;
    private $sessao_id;
    private $connect;

    function __construct($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id){
        $this->connect = new Conexao();
        $this->data = $data;
        $this->hora = $hora;
        $this->local = $local;
        $this->tipo_esporte = $tipo_esporte;
        $this->faixa_etaria = $faixa_etaria;
        $this->sessao_id = $sessao_id;
    }
    
    // Metodo de insercao de eventos no banco de dados
    public function createEvento() {
        try {
            // Sanitização dos dados
            $data = $this->sanitizeInput($this->data);
            $hora = $this->sanitizeInput($this->hora);
            $local = $this->sanitizeInput($this->local);
            $tipo_esporte = $this->sanitizeInput($this->tipo_esporte);
            $faixa_etaria = $this->sanitizeInput($this->faixa_etaria);
            $sessao_id = $this->sanitizeInput($this->sessao_id);
            
            // Validação de Dados
            if (empty($data) || empty($hora) || empty($local) || empty($tipo_esporte) || empty($faixa_etaria)) {
                throw new Exception("Todos os campos devem ser preenchidos.");
            }
            
            $conexao = $this->connect->getConnection();
            $sql = "INSERT INTO Evento (data, hora, local, tipo_esporte, faixa_etaria, fk_colaborador_id)
                  VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("sssssi", $data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id);
            $stmt->execute();
            
        } catch (Exception $e) {
            echo "Erro ao Inserir Evento: " . $e->getMessage();
        }
    }
    
    public function read() {
        try {
            $conexao = $this->connect->getConnection();
            $sql = "SELECT * FROM evento ORDER BY id ASC";
            $result = $conexao->query($sql);
            $lista = array();
            while ($row = $result->fetch_assoc()) {
                $lista[] = $this->listaEventos($row);
            }
            return $lista;
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar Buscar Todos: " . $e->getMessage();
        }
    }
    
    private function listaEventos($row) {
        $evento = new Evento($row['data'], $row['hora'], $row['local'], $row['tipo_esporte'], $row['faixa_etaria'], $row['fk_colaborador_id']);
        return $evento;
    }

    public function update(Evento $evento) {
        try {
            $conexao = $this->connect->getConnection();
            $sql = "UPDATE evento SET
                  data = ?,
                  hora = ?,
                  local = ?,
                  tipo_esporte = ?,
                  faixa_etaria = ?               
                  WHERE id = ?";
                  
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("sssssi", $evento->getData(), $evento->getHora(), $evento->getLocal(), $evento->getTipo_esporte(), $evento->getFaixa_etaria(), $evento->getId());
            $stmt->execute();
            
        } catch (Exception $e) {
            echo "Ocorreu um erro ao tentar fazer Update: " . $e->getMessage();
        }
    }

    public function delete(Evento $evento) {
        try {
            $conexao = $this->connect->getConnection();
            $sql = "DELETE FROM evento WHERE id = ?";
            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("i", $evento->getId());
            $stmt->execute();
            
        } catch (Exception $e) {
            echo "Erro ao Excluir Evento: " . $e->getMessage();
        }
    }
    
    // Método que realiza a validação dos dados
    private function validaDados($data, $hora, $local, $tipo_esporte, $faixa_etaria){
        // Implemente a validação dos dados conforme necessário
    }
    
    // Método que realiza a Sanitização dos dados
    private function sanitizeInput($input) {
        // Limpeza de entrada
        $input = trim($input);
        $input = htmlspecialchars($input);
    
        return $input;
    }
    
    function getId() {
        return $this->sessao_id;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getLocal() {
        return $this->local;
    }

    function getTipo_esporte() {
        return $this->tipo_esporte;
    }

    function getFaixa_etaria() {
        return $this->faixa_etaria;
    }

    function setId($id) {
        $this->sessao_id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setTipo_esporte($tipo_esporte) {
        $this->tipo_esporte = $tipo_esporte;
    }

    function setFaixa_etaria($faixa_etaria) {
        $this->faixa_etaria = $faixa_etaria;
    }
    public function read($sessao_id) {
        try {
            $sql = "SELECT * FROM evento WHERE fk_colaborador_id = $sessao_id";
            $result = $this->connect->getConnection()->query($sql);
            
            $f_lista = array();
            while ($row = $result->fetch_assoc()) {
                $f_lista[] = $this->listaEventos($row);
            }
            unset($evento);
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    private function listaEventos($row) {
        $evento = new Evento();
        $evento->setId($row['id']);
        $evento->setData($row['data']);
        $evento->setHora($row['hora']);
        $evento->setLocal($row['local']);
        $evento->setTipo_esporte($row['tipo_esporte']);
        $evento->setFaixa_etaria($row['faixa_etaria']);
    
        return $evento;
    }
    function __destruct(){
        $this->connect->closeConnection();
    }
}

//Evento Controller
//Instancia a classe Evento
$evento = new Evento($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id);

$d = filter_input_array(INPUT_POST);

// se a operação for cadastrar, entra nessa condição
if (isset($_POST['cadastrar'])) {
    $evento->setData($d['data']);
    $evento->setHora($d['hora']);
    $evento->setLocal($d['local']);
    $evento->setTipo_esporte($d['tipo_esporte']);
    $evento->setFaixa_etaria($d['faixa_etaria']);

    $evento->createEvento();

    header("Location: ".$_SERVER['PHP_SELF']);
} 
// se a requisição for editar
else if (isset($_POST['editar'])) {
    $evento->setId($d['id']);
    $evento->setData($d['data']);
    $evento->setHora($d['hora']);
    $evento->setLocal($d['local']);
    $evento->setTipo_esporte($d['tipo_esporte']);
    $evento->setFaixa_etaria($d['faixa_etaria']);

    $evento->update($evento);

    header("Location: ".$_SERVER['PHP_SELF']);
}
// se a requisição for deletar
else if (isset($_GET['del'])) {
    $evento->setId($_GET['del']);

    $evento->delete($evento);

    header("Location: ".$_SERVER['PHP_SELF']);
} else {
    header("Location: ".$_SERVER['PHP_SELF']);
}
