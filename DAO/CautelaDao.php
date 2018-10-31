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
            {$cautela->getPermanente()},
            {$cautela->getAberta()},
            NOW(),
            NOW(),
            NOW(),
            {$cautela->getIdPolicial()},
            {$cautela->getIdDespachante()},
            {$cautela->getIdRecebedor()})";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
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
        $query = "SELECT * FROM operador WHERE nome_funcional = '$nome_funcional'";
        
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
    //ok
    function exclui(conexao $conn, Cautela $cautela) {
        $query = "DELETE FROM cautela WHERE id = '{$cautela->getId()}'";

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
    
    function lista(conexao $conn) {
        $query = "SELECT * FROM cautela";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row["permanente"] . '</td>';
                echo '<td>' . $row["aberta"] . '</td>';
                echo '<td>' . $row["dataRetirada"] . '</td>';
                echo '<td>' . $row["vencimento"] . '</td>';
                echo '<td>' . $row["dataEntrega"] . '</td>';
                echo '<td>' . $row["idPolicial"] . '</td>';
                echo '<td>' . $row["idDespachante"] . '</td>';
                echo '<td>' . $row["idRecebedor"] . '</td>';              
                echo    '<td align="center">
                                <form name="formpolicial1" action="../view/PolicialViewEditar.php" method="POST">
                                    <button type="submit" name="editar1" value="" class="btn btn-primary btn-xs">Editar</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                    echo        '<td align="center">                                
                                        <button name="excluir" value="" class="btn btn-danger btn-xs"
                                        type="button" data-toggle="modal" data-target="#modalDeletePolicial'.$row["id"].'">Excluir</button>                                    
                                </td>';
                    
                    //Modal para confirmar a exclusão dos itens selecionados
                    //Devemos passar tanto o ID como a SIGLA para que o modal possa exibir e exluir o item
                    echo        '<!-- Modal -->
                                <div class="modal fade" id="modalDeletePolicial'.$row["id"].'" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado">Aviso de exclusão</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Deseja realmente exlcuir a cautela de ID:  <strong>'.$row["id"].'</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form name="formunidade2" action="../controller/CautelaController.php" method="POST">
                                            <button type="submit" name="excluir" value="" class="btn btn-danger">Excluir</button>
                                            <input type="hidden" name="id" value="'.$row["id"].'">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>';
                    
                echo '</tr>';                
            }
        } else {
            echo "0 results";
        }
        
    }
}
