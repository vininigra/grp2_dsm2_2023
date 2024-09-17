<?php
session_start();

// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])){
    $status = "Logado";
    $adm = $_SESSION['adm'];
    
    if($adm){
        $nome = $_SESSION['user'];
        $colaborador = $_SESSION['colaborador'];
        $session_id = $_SESSION['id'];
    }else if($colaborador = $_SESSION['colaborador']){
        $colaborador = $_SESSION['colaborador'];
        $session_id = $_SESSION['id'];
        $statusC = $_SESSION['aprovacao'];
    }else{
        $colaborador = $_SESSION['colaborador'];
        $session_id = $_SESSION['id'];
    }
   
    
} else {
    $status = "Cadastre-se";
    header('Location: login2.php');   
}
?>