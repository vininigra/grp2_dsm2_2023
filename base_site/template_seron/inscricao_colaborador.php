<?php
require('session.php');
require_once('Classes/evento.php');

//Instanciando o objeto evento
$evento = new Evento();
$id = $_GET['id'];
//Chamada do metodo de insercao de dados na tabela inscricao_particilpante
$evento->inscricaoColaborador($session_id, $id);

// Fechando conexao com o banco de dados
unset($evento);
// Exibir script de alerta
echo '<script>
    alert("Inscrição realizada com sucesso!");
    window.location.href = "eventos.php";
</script>';

?>