<?php
if(!isset($_SESSION)){
    session_start();
}

class SubunidadeDao {
    //done
    function adiciona(conexao $conn, subunidade $subunidade) {
        $query = "INSERT INTO subunidade(id, sigla, descricao, id_unid_superior) VALUES (NULL,'{$subunidade->getSigla()}','{$subunidade->getDescricao()}','{$subunidade->getUnidadeSuperior()}')";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
    
    function recuperaId(conexao $conn) {
        $query = "SELECT s.id AS id, s.sigla AS sigla, s.descricao AS descricao, u.sigla AS sigla2 FROM subunidade AS s, unidade AS u WHERE s.id_unid_superior = u.id";
        
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

    function recuperaIdSuperior(conexao $conn, $sigla) {
        //$query = "SELECT u.id FROM unidade AS u, subunidade AS s WHERE u.sigla = $unidade";
        $query = "SELECT id FROM unidade WHERE sigla = '$sigla'";
        //SELECT id FROM subunidade WHERE descricao = "3ª CIPM - Currais Novos"
        
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
    
    function recuperaDescricao(conexao $conn, $id) {
        $query = "SELECT descricao FROM subunidade WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $descricao = $row['descricao'];
                return $descricao;  
            }
        } else {
            echo "0 results";
        }      
    }
    
    function recuperaSiglaUnidade(conexao $conn, $id) {
        $query = "SELECT id_unid_superior FROM subunidade WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $id_unid_superior = $row['id_unid_superior'];
                return $id_unid_superior;  
            }
        } else {
            echo "0 results";
        }      
    }
    
    function recuperaSiglaSubunidade(conexao $conn, $id) {
        $query = "SELECT sigla FROM subunidade WHERE id = ".$id;
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $sigla = $row['sigla'];
                return $sigla;  
            }
        } else {
            echo "0 results";
        }      
    }
    
    
    //done
    function lista(conexao $conn) {
        $query = "SELECT s.id AS id, s.sigla AS sigla, s.descricao AS descricao, u.sigla AS sigla2 FROM subunidade AS s, unidade AS u WHERE s.id_unid_superior = u.id";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo    '<tr>';
                echo        '<td>'. $row["sigla"]. '</td>';
                echo        '<td>'. $row["descricao"] .'</td>';
                echo        '<td>'. $row["sigla2"] .'</td>';
                echo        '<td align="center">
                                <form name="formsubunidade1" action="SubunidadeViewEditar.php" method="POST">
                                <button type="submit" name="editar1" value="" class="btn btn-primary btn-xs">Editar</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                            echo        '<td align="center">                                
                            <button name="excluir" value="" class="btn btn-danger btn-xs"
                            type="button" data-toggle="modal" data-target="#modalDeleteSubunidade'.$row["id"].$row["sigla"].'">Excluir</button>                                    
                    </td>';
        
                //Modal para confirmar a exclusão dos itens selecionados
                //Devemos passar tanto o ID como a SIGLA para que o modal possa exibir e exluir o item
                echo        '<!-- Modal -->
                            <div class="modal fade" id="modalDeleteSubunidade'.$row["id"].$row["sigla"].'" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado">Aviso de exclusão</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Deseja realmente exlcuir a subunidade <strong>'.$row["sigla"].'</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <form name="formsubunidade2" action="../controller/SubunidadeController.php" method="POST">
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
   
    function listaSelect(conexao $conn) {
        $query = "SELECT id, sigla FROM subunidade";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value='. $row["id"].'>'. $row["sigla"].'</option>';

            }
        } else {
            echo "0 results";
        }
    }

    function listaSelectEdicao(conexao $conn, $idSubunidade) {
        $query = "SELECT id, sigla FROM subunidade";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row["id"] === $idSubunidade){
                    echo '<option selected="selected" value='. $row["id"].'>'. $row["sigla"].'</option>';
                }
                else{
                    echo '<option value='. $row["id"].'>'. $row["sigla"].'</option>';
                }
            }
        } else {
            echo "0 results";
        }
    }

    
    function exclui(conexao $conn, subunidade $subunidade) {
        $query = "DELETE FROM subunidade WHERE id = {$subunidade->getId()}";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    
    function edita(conexao $conn, subunidade $subunidade) {
        $query = "UPDATE subunidade SET sigla='{$subunidade->getSigla()}',descricao='{$subunidade->getDescricao()}',id_unid_superior={$subunidade->getUnidadeSuperior()} WHERE id={$subunidade->getId()}";
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

}
