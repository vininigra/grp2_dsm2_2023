<?php

abstract class Pessoa{

    function _construct(){
        $this->connectDatabase();
    }
    function connectDatabase($nome, $host, $user, $database){
        $mysqli = new mysqli($hostname, $user, $pass, $database);
        if($mysqli->connect_errno){
            die("Houve um erro");
    }

    }

}

?>
