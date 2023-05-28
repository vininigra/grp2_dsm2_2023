<?php


class Conexao {
    private $conn ;
    private $servername = "localhost";
    private $username = "root";
    private $password ="";
    private $dbname="seron";

    function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password,$this->dbname);
        $this->checarConexao();
    }

    public function checarConexao(){
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        
    }

    public function getConnection() {
        return $this->conn;
    }
    public function closeConnection(){
        $this->conn->close();
    }
}



?>