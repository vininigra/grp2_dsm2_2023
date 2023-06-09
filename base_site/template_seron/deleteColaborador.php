<?php
require_once('Classes/Administrador.php');
require_once('session.php');



if(isset($_GET['id'])){
    $id_colaborador = $_GET['id'];

    $adm = new Administrador();

    $adm->deleteColaboradorAdm($id_colaborador);

    if($adm){
        echo '<script>
            alert("Exclusao realizada");
            window.location.href = "adm.php";
            </script>';
    }else{
        echo '<script>
            alert("Não foi possivel excluir o cadastro");
            window.location.href = "adm.php";
            </script>';
    }
}
?>
