<?php
if(!isset($_SESSION)){
    session_start();
}

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
    
    function recuperaId($id) {
        $query = "SELECT id, sigla, descricao FROM unidade WHERE id = $id";
        
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
    
    function recuperaDescricao(conexao $conn) {
        $query = "SELECT id, sigla, descricao FROM unidade";
        
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
    
    function recuperaSigla(conexao $conn) {
        $query = "SELECT id, sigla, descricao FROM unidade";
        
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
                echo    '<tr>';
                echo        '<td>'. $row["descricao"]. '</td>';
                echo        '<td>'. $row["sigla"] .'</td>';
                echo        '<td align="center">
                                <form name="formunidade1" action="../controller/UnidadeController.php" method="POST">
                                    <button type="submit" name="editar1" value="" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                echo        '<td align="center">
                                <form name="formunidade2" action="../controller/UnidadeController.php" method="POST">
                                    <button type="submit" name="excluir" value="" class="btn btn-danger btn-xs"><i class="fa fa-times"></i>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                echo    '</tr>';
                
            }
        } else {
            echo "0 results";
        }
    }
    
    
}