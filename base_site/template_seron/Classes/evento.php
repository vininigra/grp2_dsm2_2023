<?php
require_once('Conexao.php');

class Evento{
    
    private $id;
    private $data;
    private $hora;
    private $local;
    private $tipo_esporte;
    private $faixa_etaria;
    private $sessao_id;
    private $connect;

    function __construct(){
        $this->connect = new Conexao();
    
    }
    // Metodo de insercao de eventos no banco de dados
    public function createEvento($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id) {
        try {
            $this->data = $data;
            $this->hora = $hora;
            $this->local = $local;
            $this->tipo_esporte = $tipo_esporte;
            $this->faixa_etaria = $faixa_etaria;
            $this->sessao_id = $sessao_id;
            
            // Sanitização dos dados
            $data = $this->sanitizeInput($this->data);
            $hora = $this->sanitizeInput($this->hora);
            $local = $this->sanitizeInput($this->local);
            $tipo_esporte = $this->sanitizeInput($this->tipo_esporte);
            $faixa_etaria = $this->sanitizeInput($this->faixa_etaria);
            $sessao_id = $this->sanitizeInput($this->sessao_id);
            
            // Validação de Dados
           $this->validaDados($data, $hora, $local, $tipo_esporte, $faixa_etaria);
            
            $smt = $this->insertEvento($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id);
        } catch (Exception $e) {
            alert('Erro ao cadastrar');
        }
    }
    private function insertEvento($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id){
        $sql = "INSERT INTO evento (data, hora, local, tipo_esporte, faixa_etaria, fk_colaborador_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect->getConnection()->prepare($sql);
            $stmt->bind_param("sssssi", $data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                alert('Evento cadastrado com sucesso!');
            } else {
                alert('Erro ao cadastrar evento');
            }
            
            $stmt->close();
    }

    //Metodo que realiza a validacao dos dados
    private function validaDados($data, $hora, $local, $tipo_esporte, $faixa_etaria){
         // Validação de Dados
         if (empty($data) || empty($hora) || empty($local) || empty($tipo_esporte) || empty($faixa_etaria)) {
            throw new Exception(alert('Todos os campos devem ser preenchidos.'));
            
            exit;
        }
    }
    // Metodo que realize a Sanitizacao dos dados
    private function sanitizeInput($input) {
        // Limpeza de entrada
        $input = trim($input);
        $input = htmlspecialchars($input);
    
        
    
        return $input;
    }

    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getLocal() {
        return $this->local;
    }

    function getTipo_esporte() {
        return $this->tipo_esporte;
    }

    function getFaixa_etaria() {
        return $this->faixa_etaria;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setLocal($local) {
        $this->local = $local;
    }

    function setTipo_esporte($tipo_esporte) {
        $this->tipo_esporte = $tipo_esporte;
    }

    function setFaixa_etaria($faixa_etaria) {
        $this->faixa_etaria = $faixa_etaria;
    }
    private function selectEventoP($idparticipante,$idevento){   
        // Verifique se há resultados
        $query = "SELECT fk_evento_id, fk_participante_id FROM inscricao_participante WHERE fk_evento_id = '$idevento' AND fk_participante_id = '$idparticipante'";
        $result = $this->connect->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            echo "Erro ao executar a query: " . $query . "<br>" . $this->connect->getConnection()->error;
            return false;
        }
    }
    private function selectEventoC($idcolaborador,$idevento){
        // Verifique se há resultados
        $query = "SELECT fk_evento_id, fk_colaborador_id FROM inscricao_colaborador WHERE fk_evento_id = '$idevento' AND fk_colaborador_id = '$idcolaborador'";
        $result = $this->connect->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            echo "Erro ao executar a query: " . $query . "<br>" . $this->connect->getConnection()->error;
            return false;
        }
    }
    
   
    private function selectEvento(){
        $query = "CALL SP_LISTAREVENTOS";
        $stmt = $this->connect->getConnection()->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
            return $rows;
        }
    }
    public function listaEvento($colaborador, $sessao_id) {
        // Chamada do método que faz a select do evento dentro do banco de dados
        $rows = $this->selectEvento();
        if($rows){
        
    
            // Percorra os resultados e exiba os eventos
            foreach ($rows as $row) {
                // Extraindo os valores das colunas
                $id = $row['id'];
                $data = $row['data'];
                $hora = $row['hora'];
                $local = $row['local'];
                $esporte = $row['Esporte'];
                $faixaEtaria = $row['faixa_etaria'];
    
                // Exibindo os eventos com a estilização desejada
                echo '
                    <div class="col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="thumb">
                                <div class="thumb-img">
                                    <img src="img/volei.jpg" alt="">
                                </div>
                                <div class="overlay-content">
                                    <strong title="Author"><i class="fa fa-user"></i>'.$local. '</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong title="Posted on"><i class="fa fa-calendar"></i> '.$data.' '.$hora.'</strong> &nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="down-content">
                                <h4>'.$esporte.'</h4>
                                <p>'.$local.'</p>';
    
                if ($colaborador) {
                    // Verificando a inscrição do colaborador
                    
                    $inscricaoResult = $this->selectEventoC($sessao_id,$id);
                    if ($inscricaoResult && $inscricaoResult->num_rows > 0) {
                        echo '<div class="text-button">
                               
                                <a href="cancela_inscricaoC.php?id='.$id.'">Cancelar Inscrição</a>
                              </div>';
                    } else {
                        echo '<div class="text-button">
                                <a href="inscricao_colaborador.php?id='.$id.'">Inscrever-se</a>
                              </div>';
                              
                    }
                }else{
                    // Verificando a inscrição do participante
                    $inscricaoResult = $this->selectEventoP($sessao_id,$id);
                    if ($inscricaoResult && $inscricaoResult->num_rows > 0) {
                        echo '<div class="text-button">
                                    <a href="cancela_inscricaoP.php?id='.$id.'">Cancelar Inscrição</a>
                                </div>';
                    }else{
                        echo '<div class="text-button">
                                <a href="inscricao_participante.php?id='.$id.'">Inscrever-se</a>
                              </div>';
                    }
                }
                echo '
                            </div>
                        </div>
                    </div>
                ';
            }
        } else {
            echo "Nenhum evento encontrado.";
        }
    }
    // Metodo que seleciona os eventos que o colaborador criou
    private function selectEventoCriado($sessao_id){
        $sql = "SELECT * FROM evento WHERE fk_colaborador_id = $sessao_id";
        $result = $this->connect->getConnection()->query($sql);
        return $result;
    }
    public function read($sessao_id) {
        try {
            $result = $this->selectEventoCriado($sessao_id);
            
            $f_lista = array();
            while ($row = $result->fetch_assoc()) {
                $f_lista[] = $this->listaEventos($row);
            }
            unset($evento);
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
        
    }
    private function listaEventos($row) {
        $evento = new Evento();
        $evento->setId($row['id']);
        $evento->setData($row['data']);
        $evento->setHora($row['hora']);
        $evento->setLocal($row['local']);
        $evento->setTipo_esporte($row['tipo_esporte']);
        $evento->setFaixa_etaria($row['faixa_etaria']);
    
        return $evento;
        header("Location: lista_evento.php");
    }
    public function cancelaInscricaoParticipante($sessao_id,$id_evento){
        $query = "DELETE FROM inscricao_participante WHERE fk_evento_id = ? AND fk_participante_id = ?";
        $stmt = $this->connect->getConnection()->prepare($query);
        $stmt->bind_param("ii",$id_evento,$sessao_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0){
            exit;
        }

    }
    public function cancelaInscricaoColaborador($sessao_id,$id_evento){
        $query = "DELETE FROM inscricao_colaborador WHERE fk_evento_id = ? AND fk_colaborador_id = ?";
        $stmt = $this->connect->getConnection()->prepare($query);
        $stmt->bind_param("ii",$id_evento,$sessao_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0){
            exit;
            }
        }
    public function inscricaoPartipante($sessao_id,$id_evento){
        $query = "INSERT INTO inscricao_participante(fk_evento_id,fk_participante_id) VALUES (?,?)";
        $stmt = $this->connect->getConnection()->prepare($query);
        $stmt->bind_param("ii",$id_evento,$sessao_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Inscricao realizada.";
        } else {
            echo "Erro ao se inscrever.";
        }
        $stmt->close();
    }
    public function inscricaoColaborador($sessao_id,$id_evento){
        $query = "INSERT INTO inscricao_colaborador(fk_evento_id,fk_colaborador_id) VALUES (?,?)";
        $stmt = $this->connect->getConnection()->prepare($query);
        $stmt->bind_param("ii",$id_evento,$sessao_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Inscricao realizada.";
        } else {
            echo "Erro ao se inscrever.";
            }
    }
    private function updateData($data,$sessao_id,$id_evento){
        $data = "UPDATE evento SET data = '$data' WHERE fk_colaborador_id = '$sessao_id' AND id = '$id_evento'";
        if($this->connect->getConnection()->query($data)=== TRUE){
            echo "Dados inseridos";
            return $data;
            }
    }
    private function updateHora($hora,$sessao_id,$id_evento){
        $hora = "UPDATE evento SET hora = '$hora' WHERE fk_colaborador_id = '$sessao_id'AND id = '$id_evento'";
        if($this->connect->getConnection()->query($hora)=== TRUE){
            echo "Dados inseridos";
            return $hora;
        }
    }
    private function updateLocal($local,$sessao_id,$id_evento){
        $local = "UPDATE evento SET local = '$local' WHERE fk_colaborador_id = '$sessao_id'AND id = '$id_evento'";
        if($this->connect->getConnection()->query($local)=== TRUE){
            echo "Dados inseridos";
            return $local;
        
        }
    }
    private function updateTipoEsporte($tipo_esporte,$sessao_id,$id_evento){
        $tipo_esporte = "UPDATE evento SET tipo_esporte = '$tipo_esporte' WHERE fk_colaborador_id = '$sessao_id'AND id = '$id_evento'";
        if($this->connect->getConnection()->query($tipo_esporte)=== TRUE){
            echo "Dados inseridos";
            return $tipo_esporte;
        }
    }
    private function updateFaixaEtaria($faixa_etaria,$sessao_id,$id_evento){
        $faixa_etaria = "UPDATE evento SET faixa_etaria = '$faixa_etaria' WHERE fk_colaborador_id = '$sessao_id'AND id = '$id_evento'";
        if($this->connect->getConnection()->query($faixa_etaria)=== TRUE){
            echo "Dados inseridos";
            return $faixa_etaria;
        }
    }

    public function update($data, $hora, $local, $tipo_esporte, $faixa_etaria, $sessao_id,$id_evento){
        $result = $this->selectEventoCriado($sessao_id);
        
        if($result->num_rows > 0){
            $data = $this->updateData($data, $sessao_id,$id_evento);   
            $hora = $this->updateHora($hora, $sessao_id,$id_evento);
            $local = $this->updateLocal($local, $sessao_id,$id_evento);
            $tipo_esporte = $this->updateTipoEsporte($tipo_esporte, $sessao_id,$id_evento);
            $faixa_etaria = $this->updateFaixaEtaria($faixa_etaria, $sessao_id,$id_evento);
         }else{
                echo "Evento não cadastrado!!";
            }
    }
    private function deleteEvento($evento, $sessao_id){
        $delete = "DELETE FROM evento WHERE id = '$evento' AND fk_colaborador_id = '$sessao_id'";
        if($this->connect->getConnection()->query($delete)=== TRUE){
            echo "Evento deletado com sucesso";
        } else {
            echo "Erro ao deletar evento: " . $this->connect->getConnection()->error;
        }    
    }
    public function delete($evento, $sessao_id) {
        $result = $this->selectEventoCriado($sessao_id);
    
        if ($result->num_rows > 0) {
            $delete = $this->deleteEvento($evento, $sessao_id);
        } else {
            echo "Evento não encontrado";
        }
    }

    
    function __destruct(){
        $this->connect->closeConnection();

    }
}
?>
