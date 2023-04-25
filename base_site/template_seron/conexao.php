<?php
    $hostname = "localhost";
    $database = "name";
    $user = "root";
    $pass = "";

    $mysqli = new mysqli($hostname, $user, $pass, $database);
    if($mysqli->connect_errno){
        die("Houve um erro");
    }





?>