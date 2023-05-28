<?php

/*
    Criação da classe Evento com o CRUD
*/
class EventoDAO{
    
    public function create(Evento $evento) {
        try {
            $sql = "INSERT INTO Evento (                   
                  data,hora,local,tipo_esporte,faixa_etaria)
                  VALUES (
                  :data,:hora,:local,:tipo_esporte,:faixa_etaria)";

            $p_sql = ConexaoEvento::getConexaoEvento()->prepare($sql);
            $p_sql->bindValue(":data", $evento->getData());
            $p_sql->bindValue(":hora", $evento->getHora());
            $p_sql->bindValue(":local", $evento->getLocal());
            $p_sql->bindValue(":tipo_esporte", $evento->getTipo_esporte());
            $p_sql->bindValue(":faixa_etaria", $evento->getFaixa_etaria());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir Evento <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM evento order by id asc";
            $result = ConexaoEvento::getConexaoEvento()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaEventos($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Evento $evento) {
        try {
            $sql = "UPDATE evento set
                
                  data=:data,
                  hora=:hora,
                  local=:local,
                  tipo_esporte=:tipo_esporte,
                  faixa_etaria=:faixa_etaria                
                                                                       
                  WHERE id = :id";
            $p_sql = ConexaoEvento::getConexaoEvento()->prepare($sql);
            $p_sql->bindValue(":data", $evento->getData());
            $p_sql->bindValue(":hora", $evento->getHora());
            $p_sql->bindValue(":local", $evento->getLocal());
            $p_sql->bindValue(":tipo_esporte", $evento->getTipo_esporte());
            $p_sql->bindValue(":faixa_etaria", $evento->getFaixa_etaria());
            $p_sql->bindValue(":id", $evento->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Evento $evento) {
        try {
            $sql = "DELETE FROM evento WHERE id = :id";
            $p_sql = ConexaoEvento::getConexaoEvento()->prepare($sql);
            $p_sql->bindValue(":id", $evento->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir Evento<br> $e <br>";
        }
    }


    

    
 }

 ?>
