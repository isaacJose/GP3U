<?php
require_once "../controller/Uteis.php";
class CautelaDao {
    function adiciona(conexao $conn, Cautela $cautela) {
          
        $query = "INSERT INTO cautela(
            id,
            permanente,
            aberta,
            dataRetirada,
            vencimento,
            dataEntrega,
            idPolicial,
            idDespachante,
            idRecebedor
        )VALUES(
            NULL,
            '{$cautela->getPermanente()}',
            1,
            CURDATE(),
            IF('{$cautela->getPermanente()}' = 0, CURDATE() + 1, NULL),
            NULL,
            '{$cautela->getIdPolicial()}',
            '{$cautela->getIdDespachante()}',
            NULL)";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

    function listaSelect(conexao $conn) {
        $query = "SELECT id FROM cautela";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value='. $row["id"].'>'. $row["id"].'</option>';

            }
        } else {
            echo "0 results";
        }
    }

    //ok
    function recuperaId(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                return $id;  
            }
        } else {
            echo "0 results";
        }      
    }
    //Funçao que irá recuperar o Id do operador a partir do nome funcional do mesmo, para logo após esse id ser cadastrado na cautela.
    function recuperaIdOperador(conexao $conn, $nome_funcional) {
        $query = "SELECT * FROM operador WHERE nome_funcional = ".$nome_funcional;
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                return $id;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaPolicial(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $policial = $row['policial'];
                return $policial;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaArmamento(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $armamento = $row['armamento'];
                return $armamento;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaQuantidade(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $quantidade = $row['quantidade'];
                return $quantidade;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaTipo_cautela(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $tipo_cautela = $row['tipo_cautela'];
                return $tipo_cautela;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaVencimento(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $vencimento = $row['vencimento'];
                return $vencimento;  
            }
        } else {
            echo "0 results";
        }      
    }

    function recuperaPermanente(conexao $conn, $id) {
        $query = "SELECT * FROM cautela WHERE id = ".$id;
        
        $result = mysqli_query($conn->conecta(), $query);

        $permanente = 0;
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $permanente = $row['permanente'];
            }
        }
        return $permanente;     
    }
    //ok
    function exclui(conexao $conn, Cautela $cautela) {
        $query = "DELETE FROM cautela WHERE id = '{$cautela->getId()}'";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //funçao que exclui o item de uma cautela
    function excluiItemCautela(conexao $conn, $id) {
        $query = "DELETE FROM item_cautela WHERE idCautela = $id";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //done
    function edita(conexao $conn, Cautela $cautela) {
        $query = "";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

    function devolucao(conexao $conn, $idCautela, $idRecebedor) {
        
        $permanente = $this->recuperaPermanente($conn, $idCautela);

        $query = "UPDATE cautela SET 
                aberta = 0,
                permanente = IF({$permanente} = 1, 1, 0),
                dataEntrega = CURDATE(),
                idRecebedor = {$idRecebedor}                
                WHERE id = {$idCautela}";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

    
    //done
    function lista(conexao $conn) {      
        $query = "SELECT a.*, b.nome_funcional as recebedor 
        FROM (SELECT
                c.id,
                IF(c.permanente=1, 'Permanente', 'Temporária') AS permanente,
                IF(c.aberta=1, 'Aberta', 'Fechada') AS aberta,
                c.dataRetirada,
                c.vencimento,
                c.dataEntrega,
                c.idPolicial,
                c.idDespachante,
                c.idRecebedor,
                o.graduacao as grad_despachante,
                o.nome_funcional as despachante,
                p.nome_funcional as nome_policial,
                p.graduacao as grad_policial,
                i.serial as serial,
                i.modelo as modelo,
                c.quantidade as quantidade,
                tp.descricao as tipo_item,
                date_format(dataRetirada,'%d/%m/%Y') AS dataRetiradaFormatada,
                date_format(vencimento,'%d/%m/%Y') AS dataVencimentoFormatada,
                date_format(dataEntrega,'%d/%m/%Y') AS dataEntregaFormatada,
                --IF(permanente=1, 'Aberta', 'Fechada')
            FROM
                cautela c, policial p, operador o, item i, tipo_item tp
            WHERE 
                i.id = c.idItem and c.aberta = 1 and p.id = c.idPolicial and 
                o.id = idDespachante and i.id_tipo_item = tp.id
                ORDER BY c.id DESC) a LEFT JOIN operador b
                ON a.idRecebedor = b.id";
        
        $result = mysqli_query($conn->conecta(), $query);

        $uteis = new Uteis();

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) { 
                echo '<tr>';
                        
                    echo '<td>' . $row["id"] . '</td>';
                    echo '<td>' . $row["permanente"] . '</td>';
                    echo '<td>' . $row["aberta"] . '</td>';
                    echo '<td>' . $row["dataRetiradaFormatada"] . '</td>';
                    echo '<td>' . $row["dataVencimentoFormatada"] . '</td>';
                    //echo '<td>' . $row["dataEntregaFormatada"] . '</td>';
                    echo '<td>' . $row["grad_policial"] ." ". $row["nome_policial"] . '</td>';
                    echo '<td>' . $row["grad_despachante"] ." ". $row["despachante"] . '</td>';
                    //echo '<td>' . $row["recebedor"] . '</td>';
                
                    $stringPolicial = $uteis->sanitizeString($row["nome_policial"]);
                    $stringTipoItem = $uteis->sanitizeString($row["tipo_item"]);
                    $stringModelo = $uteis->sanitizeString($row["modelo"]);
                    $stringSerial = $uteis->sanitizeString($row["serial"]);                    


                    //Botão mostrar item
                    echo'<td align="center">                                
                        <button name="mostrarItem" value="" class="btn btn-cancel btn-xs"
                        type="button" data-toggle="modal" data-target="#modalMostraItem'.$stringTipoItem.
                        $stringModelo.
                        $stringSerial.
                        $row["quantidade"].'">Mostrar Item</button>                                    
                    </td>';

                    //Botão dar baixa
                    echo'<td align="center">                                
                        <button name="devolverItem" value="" class="btn btn-success btn-xs"
                        type="button" data-toggle="modal" data-target="#modalDevolverCautela'.$row["id"].
                        $stringPolicial.
                        $stringTipoItem.
                        $stringModelo.
                        $stringSerial.
                        $row["quantidade"].'">Dar baixa</button>                                    
                    </td>';

                    
                    //Modal para mostrar os itens
                    echo'<!-- Modal -->
                        <div class="modal fade" id="modalMostraItem'.$stringTipoItem.
                        $stringModelo.
                        $stringSerial.
                        $row["quantidade"].'" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalCentralizado">Item da cautela</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Tipo: <strong>'.$stringTipoItem.'</strong> </br>
                                Modelo: <strong>'.$stringModelo.'</strong> </br>
                                Serial: <strong>'.$stringSerial.'</strong> </br>
                                Quantidade: <strong>'.$row["quantidade"].'</strong> </br> </br>
                            </div>
                            </div>
                            </div>
                        </div>';
                   
                        

                         //Modal de devolução
                         echo        '<!-- Modal -->
                         <div class="modal fade" id="modalDevolverCautela'.$row["id"].
                                $stringPolicial.
                                $stringTipoItem.
                                $stringModelo.
                                $stringSerial.
                                $row["quantidade"].'" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                             <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="TituloModalCentralizado">Confirmação de inspeção</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                Policial: <strong>'.$stringPolicial.'</strong> </br> </br>
                                Tipo: <strong>'.$stringTipoItem.'</strong> </br>
                                Modelo: <strong>'.$stringModelo.'</strong> </br>
                                Serial: <strong>'.$stringSerial.'</strong> </br>
                                Quantidade: <strong>'.$row["quantidade"].'</strong> </br> </br>
                                <center><strong>Confirma a devolução deste item?</strong></center>
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                 <form name="formunidade2" action="../controller/CautelaController.php" method="POST">
                                     <button type="submit" name="devolver" value="" class="btn btn-primary">Realizar devolução</button>
                                     <input type="hidden" name="id" value="'.$row["id"].'">
                                 </form>
                             </div>
                             </div>
                         </div>
                         </div>';

                      echo '</td>';
                       
                }
            } else {
                echo "0 results";
            }    

        }

    function listaCautelaItemDao(conexao $conn, $id) {
        $query = "SELECT * FROM item_cautela WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["idItem"] . '</td>';
                echo '<td>' . $row["quantidade"] . '</td>';             
                
                echo    '<td align="center">
                                <form name="formpolicial1" action="../view/CautelaController.php" method="POST">
                                    <button type="submit" name="excluiritem" value="" class="btn btn-primary btn-xs">Excluir</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                echo '</tr>';                
            }
        } else {
            echo "0 results";
        }
        
    }
}
