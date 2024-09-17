<?php
session_start();

// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])){
     $adm = $_SESSION['adm'];
     $status = "Logado";
     $colaborador = $_SESSION['colaborador'];
} else {
     $status = "Cadastre-se";
    
}

?>