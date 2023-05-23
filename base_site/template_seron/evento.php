<?php

class Evento{
    
    private $id;
    private $data;
    private $hora;
    private $local;
    private $tipo_esporte;
    private $faixa_etaria;
    //oi
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

    
}
?>

