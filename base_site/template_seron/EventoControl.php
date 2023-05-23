<?php
include_once "Conexao_evento.php";
include_once "evento.php";
include_once "Criar_evento.php";

//instancia as classes
$evento = new Evento();
$eventodao = new EventoDAO();

//pega todos os dados passado por POST

$d = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){

    $evento->setData($d['data']);
    $evento->setHora($d['hora']);
    $evento->setLocal($d['local']);
    $evento->setTipo_esporte($d['tipo_esporte']);
    $evento->setFaixa_etaria($d['faixa_estaria']);

    $eventodao->create($evento);

    header("Location: ./");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){

    $evento->setData($d['data']);
    $evento->setHora($d['hora']);
    $evento->setLocal($d['local']);
    $evento->setTipo_esporte($d['tipo_esporte']);
    $evento->setFaixa_etaria($d['faixa_estaria']);

    $eventodao->update($evento);

    header("Location: ./");
}
// se a requisição for deletar
else if(isset($_GET['del'])){

    $evento->setId($_GET['del']);

    $eventodao->delete($evento);

    header("Location: ./");
}else{
    header("Location: ./");
}