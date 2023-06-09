<?php
require_once('Classes/Administrador.php');
require_once('session.php');

//Verificando se o id foi passado como parametro
if(isset($_GET['id'])){
    $id_colaborador = $_GET['id'];

    $adm = new Administrador();
    $adm->aprovaColaborador($id_colaborador);

    unset($adm);

    echo '<script>
            alert("Liberado com sucesso");
            window.location.href = "listaColaboradorAdm.php";
            </script>';
}

?>
