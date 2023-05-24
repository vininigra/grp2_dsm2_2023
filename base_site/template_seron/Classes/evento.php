<?php
require_once('Conexao.php');

class Evento{
    
    
    private $data;
    private $hora;
    private $local;
    private $tipo_esporte;
    private $faixa_etaria;
    private $connect;

    function __construct(){
        $this->connect = new Conexao();

    }
    public function createEvento($data, $hora, $local, $tipo_esporte, $faixa_etaria) {
        try {
            
            
            
            $sql = "INSERT INTO Evento (                   
                  data,hora,local,tipo_esporte,faixa_etaria)
                  VALUES (
                    '$data','$hora','$local','$tipo_esporte','$faixa_etaria')";

            $p_sql = $this->connect->getConnection()->query($sql);

           
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir Evento <br>" . $e . '<br>';
        }
    }
    function getId() {
        return $this->id;
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
        $this->id = $id;
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

    function __destruct(){
        $this->connect->closeConnection();

    }
}
?>

