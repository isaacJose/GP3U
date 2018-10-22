<?php

class ItemDao {
    function adiciona(conexao $conn, Item $item) {
          
        $query = "INSERT INTO item(
                id, 
                serial, 
                modelo, 
                estoque, 
                estoque_danificado, 
                situacao, validade, 
                observacoes, 
                id_subunidade, 
                id_tipo_item, 
                id_fabricante
            ) VALUES (
                NULL,
                '{$item->getSerial()}',
                '{$item->getModelo()}',
                '{$item->getEstoque()}',
                '{$item->getEstoque_danificado()}',
                '{$item->getSituacao()}',
                '{$item->getValidade()}',
                '{$item->getObservacoes()}',
                '{$item->getId_subunidade()}',
                '{$item->getId_tipo_item()}',
                '{$item->getId_fabricante()}''
            )";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //ok
    function recuperaId(conexao $conn) {
        $query = "SELECT * FROM item";
        
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
    function recuperaSerial(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $serial = $row['serial'];
                return $serial;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaModelo(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $modelo = $row['modelo'];
                return $modelo;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaEstoque(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $estoque = $row['estoque'];
                return $estoque;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaEstoque_danificado(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $estoque_danificado = $row['estoque_danificado'];
                return $estoque_danificado;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaSituacao(conexao $conn) {
        $query = "SELECT * FROM item";
        
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
    //ok
    function recuperaValidade(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $validade = $row['validade'];
                return $validade;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaObservacoes(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $observacoes = $row['observacoes'];
                return $observacoes;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaId_subunidade(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id_subunidade = $row['id_subunidade'];
                return $id_subunidade;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaId_tipo_item(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id_tipo_item = $row['id_tipo_item'];
                return $id_tipo_item;  
            }
        } else {
            echo "0 results";
        }      
    }
    //ok
    function recuperaId_fabricante(conexao $conn) {
        $query = "SELECT * FROM item";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id_fabricante = $row['id_fabricante'];
                return $id_fabricante;  
            }
        } else {
            echo "0 results";
        }      
    }   
    
    function exclui(conexao $conn, Item $item) {
        $query = "DELETE FROM item WHERE id = '{$item->getId()}'";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //done
    function edita(conexao $conn, Item $item) {
        //$query = "UPDATE policial SET nome='{$policial->getNome()}',graduacao='{$policial->getGraduacao()}',nome_funcional='{$policial->getNome_funcional()}',matricula='{$policial->getMatricula()}',email='{$policial->getEmail()}',situacao='{$policial->getSituacao()}',id_subunidade=(SELECT id FROM subunidade WHERE sigla = '{$policial->getId_subunidade()}') WHERE id = {$policial->getId()}";
        $query = "UPDATE item SET serial='{$item->getSerial()}',modelo='{$item->getModelo()}',estoque={$item->getEstoque()},estoque_danificado={$item->getEstoque_danificado()},`situacao`=[value-6],`validade`=[value-7],`observacoes`=[value-8],`id_subunidade`=[value-9],`id_tipo_item`=[value-10],`id_fabricante`=[value-11] WHERE 1";
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    
    function lista(conexao $conn) {
        $query = "SELECT i.id AS id, i.serial AS serial, i.modelo AS modelo, i.estoque AS quantidade, i.estoque_danificado AS estoque_danificado, i.situacao AS situacao, i.validade AS validade, i.observacoes AS observacoes, i.id_subunidade AS id_subunidade, i.id_tipo_item AS id_tipo_item, i.id_fabricante AS id_fabricante, t.descricao AS tipo, f.descricao AS fabricante FROM item AS i, tipo_item AS t, fabricante AS f WHERE i.id_tipo_item = t.id AND i.id_fabricante = f.id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                    echo '<td>' . $row["tipo"] . '</td>';
                    echo '<td>' . $row["fabricante"] . '</td>';
                    echo '<td>' . $row["modelo"] . '</td>';
                    echo '<td>' . $row["serial"] . '</td>';
                    echo '<td>' . $row["quantidade"] . '</td>';
                    echo '<td>' . $row["situacao"] . '</td>';
    
                    echo        '<td align="center">                                
                        <button name="excluir" value="" class="btn btn-danger btn-xs"
                        type="button" data-toggle="modal" data-target="#modalDeleteItem'.$row["id"].$row["modelo"].'">Excluir</button>                                    
                    </td>';
    
                    //Modal para confirmar a exclusão dos itens selecionados
                    //Devemos passar tanto o ID como a SIGLA para que o modal possa exibir e exluir o item
                    echo        '<!-- Modal -->
                                <div class="modal fade" id="modalDeleteItem'.$row["id"].$row["modelo"].'" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado">Aviso de exclusão</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Deseja realmente exlcuir o item <strong>'.$row["modelo"].'</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form name="formunidade2" action="../controller/ItemController.php" method="POST">
                                            <button type="submit" name="excluir" value="" class="btn btn-danger">Excluir</button>
                                            <input type="hidden" name="id" value="'.$row["id"].'">
                                        </form>
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
