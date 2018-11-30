<?php
//done
require_once "../controller/Uteis.php";
class InspecaoDao {
    //
    function adiciona(conexao $conn, Inspecao $inspecao) {
        $query = "INSERT INTO inspecao (id, dataUltima, dataProxima, situacao, idCautela) 
        VALUES 
        (NULL,
        '{$inspecao->getDataUltima()}',
        '{$inspecao->getDataProxima()}',
        '{$inspecao->getSituacao()}',
        '{$inspecao->getIdCautela()}')";
        
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

    function realizaInspecao(conexao $conn, Inspecao $inspecao){
        $query = "UPDATE inspecao SET 
                dataUltima = CURDATE(), 
                dataProxima = DATE_ADD(CURDATE(), INTERVAL 3 MONTH), 
                situacao = 'Em dia'
                WHERE id = '{$inspecao->getId()}'";
        
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Atualização realizada com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

    function recuperaIdCautela(conexao $conn, $id) {
        $query = "SELECT idCautela FROM inspecao WHERE id = ".$id;
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $idCautela = $row['idCautela'];
                return $idCautela;  
            }
        } else {
            echo "0 results";
        }      
    }

    function recuperaDataUltima(conexao $conn, $id) {
        $query = "SELECT dataUltima FROM inspecao WHERE id = ".$id;
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $dataUltima = $row['dataUltima'];
                return $dataUltima;  
            }
        } else {
            echo "0 results";
        }      
    }

    function recuperaDataProxima(conexao $conn, $id) {
        $query = "SELECT dataProxima FROM inspecao WHERE id = ".$id;
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $dataProxima = $row['dataProxima'];
                return $dataProxima;  
            }
        } else {
            echo "0 results";
        }      
    }

    function recuperaSituacao(conexao $conn, $id) {
        $query = "SELECT situacao FROM inspecao WHERE id = ".$id;
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $situacao = $row['situacao'];
                return $situacao;  
            }
        } else {
            echo "0 results";
        }      
    }

    function exclui(conexao $conn, Inspecao $inspecao) {
        $query = "DELETE FROM inspecao WHERE id = {$inspecao->getId()}";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    
    function edita(conexao $conn, Inspecao $inspecao) {
        $query = "UPDATE inspecao SET 
                  dataUltima='{$inspecao->getDataUltima()}', 
                  dataProxima='{$inspecao->getDataProxima()}', 
                  situacao='{$inspecao->getSituacao()}', 
                  idCautela={$inspecao->getIdCautela()} 
                  WHERE id={$inspecao->getId()}";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

    function lista(conexao $conn) {
        $query = "SELECT i.id,
        p.nome_funcional as policial, 
        i.id as idInspecao, 
        c.id as idCautela, 
        i.dataUltima as dataUltima, 
        i.dataProxima as dataProxima, 
        i.situacao as situacao,
        c.quantidade as quantidade,
        item.serial as serialItem,
        item.modelo as modeloItem,
        tipo.descricao as descricaoItem
        
        FROM inspecao i, cautela c , policial p, item item, tipo_item tipo
        
        WHERE i.idCautela = c.id and  
                c.idPolicial = p.id and 
                item.id_tipo_item = tipo.id and 
                c.idItem = item.id;";
        
        $result = mysqli_query($conn->conecta(), $query);

        $uteis = new Uteis();

        if (mysqli_num_rows($result) > 0) {
            //while($row = mysqli_fetch_assoc($result)) {  
            while($row = mysqli_fetch_assoc($result)) { 
                echo '<tr>'; 
                
                    echo '<td>' . $row["policial"] . '</td>';       
                    echo '<td>' . $row["dataUltima"] . '</td>';
                    echo '<td>' . $row["dataProxima"] . '</td>';
                    echo '<td>' . $row["situacao"] . '</td>';
                    
                    $stringDescricaoItem = $uteis->sanitizeString($row['descricaoItem']);
                    $stringModeloItem = $uteis->sanitizeString($row['modeloItem']);
                    $stringSerialItem = $uteis->sanitizeString($row['serialItem']);
                    //Botão ver item
                    echo '<td align="center">
                              <button type="button" name="mostraItem" value="" class="btn btn-cancel btn-xs"
                              data-toggle="modal" data-target="#modalVerItem'.$row["id"].
                              $stringDescricaoItem.
                              $stringModeloItem.
                              $stringSerialItem.
                              $row["quantidade"].'">Ver item</button>                                
                    </td>';
                    //Botão realizar inspeção
                    echo '<td align="center">                            
                                <button type="submit" name="itens" value="" class="btn btn-success btn-xs">
                                Realizar inspeção</button>
                    </td>';

                    //Modal para ver o item

                    echo        '<!-- Modal -->
                                <div class="modal fade" id="modalVerItem'.$row["id"].
                                $stringDescricaoItem.
                                $stringModeloItem.
                                $stringSerialItem.
                                $row["quantidade"].'" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado">Item cautelado</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Tipo: <strong>'.$stringDescricaoItem.'</strong> </br>
                                        Modelo: <strong>'.$stringModeloItem.'</strong> </br>
                                        Serial: <strong>'.$stringSerialItem.'</strong> </br>
                                        Quantidade: <strong>'.$row["quantidade"].'</strong> </br>
                                    </div>
                                    
                                    </div>
                                </div>
                                </div>';
                    echo    '</tr>';
                                     
        }  
        } else {
            echo "0 results";
        }
        
    }
}