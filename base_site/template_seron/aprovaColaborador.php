<?php
require_once('Classes/Administrador.php');
require_once('session.php');

//Verificando se o id foi passado como parametro
if(isset($_GET['id'])){
    $id_colaborador = $_GET['id'];

    $adm = new Administrador();
    if($adm->checaAprovacao($id_colaborador) == TRUE){
        $adm->recusaColaborador($id_colaborador);
        echo '<script>
            alert("Pendenciado");
            window.location.href = "adm.php";
            </script>';
    }else{
        $adm->aprovaColaborador($id_colaborador);
        echo '<script>
            alert("Liberado com sucesso");
            window.location.href = "adm.php";
            </script>';
    }
   

    unset($adm);

    
}

?>
