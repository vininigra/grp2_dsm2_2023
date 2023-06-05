
<?php
session_start();
// Verifica se a sessão está iniciada
if (isset($_SESSION['loggedin'])) {
     $status = "Logado";
     $sessao_id = $_SESSION['id'];
} else {
    header('location: index.php');
}
?>