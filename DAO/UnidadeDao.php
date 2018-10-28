<?php
if(!isset($_SESSION)){
    session_start();
}

require_once "../controller/Uteis.php";

//done
class unidadeDao{    
    //done
    function adiciona(conexao $conn, unidade $unidade) {
        $query = "INSERT INTO unidade(id, sigla, descricao) VALUES (NULL,'{$unidade->getSigla()}','{$unidade->getDescricao()}')";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    
    function recuperaDescricao(conexao $conn, $id) {
        $query = "SELECT descricao FROM unidade WHERE id = $id";
        
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
    
    function recuperaSigla(conexao $conn, $id) {
        $query = "SELECT sigla FROM unidade WHERE id = $id";
        
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
    function exclui(conexao $conn, unidade $unidade) {
        $query = "DELETE FROM unidade WHERE id = {$unidade->getId()}";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }    
    //done
    function edita(conexao $conn, unidade $unidade) {
        $query = "UPDATE unidade SET sigla='{$unidade->getSigla()}',descricao='{$unidade->getDescricao()}' WHERE id = {$unidade->getId()}";
        
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }    
    //done
    function lista(conexao $conn) {
        $query = "SELECT id, sigla, descricao FROM unidade ORDER BY id";

        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) >= 0) {
            while($row = mysqli_fetch_assoc($result)) { 
                $uteis = new Uteis();   
                $stringModal = $uteis->sanitizeString($row["sigla"]);
                $id = $row["id"];
                echo    '<tr>';
                echo        '<td>'. $row["descricao"]. '</td>';
                echo        '<td>'. $row["sigla"] .'</td>';
                
                echo        '<td align="center">
                                <form name="formunidade1" action="UnidadeViewEditar.php" method="POST">
                                    <button type="submit" name="editar1" value="" class="btn btn-primary btn-xs">Editar</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                echo        '<td align="center">                                
                                    <button name="excluir" value="" class="btn btn-danger btn-xs"
                                    type="button" data-toggle="modal" data-target="#ExemploModalCentralizado'.$row["id"].$stringModal.'">Excluir</button>                                    
                            </td>';
                
                //Modal para confirmar a exclusão dos itens selecionados
                //Devemos passar tanto o ID como a SIGLA para que o modal possa exibir e exluir o item
                echo        '<!-- Modal -->
                            <div class="modal fade" id="ExemploModalCentralizado'.$row["id"].$stringModal.'" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalCentralizado">Aviso de exclusão</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Deseja realmente exlcuir a unidade <strong>'.$row["sigla"].'</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <form name="formunidade2" action="../controller/UnidadeController.php" method="POST">
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
        $query = "SELECT id, sigla FROM unidade";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value='. $row["id"].'>'. $row["sigla"].'</option>';
            }
        } else {
            echo "0 results";
        }
    }

    function listaSelectEdicao(conexao $conn, $idUnidade) {
        $query = "SELECT id, sigla FROM unidade";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row["id"] === $idUnidade){
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
}
