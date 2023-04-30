<?php
include('dados.php');

class Conexao{
    function __construct($servername, $username, $password, $dbname){
        $conn = new mysqli($servername, $username, $password,$dbname);
        $this->checarConexao($conn);
    }

    public function checarConexao($conn){
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
    }
}




?>