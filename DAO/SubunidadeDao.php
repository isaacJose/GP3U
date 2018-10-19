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
    
    function recuperaDescricao(conexao $conn) {
        $query = "SELECT s.id AS id, s.sigla AS sigla, s.descricao AS descricao, u.sigla AS sigla2 FROM subunidade AS s, unidade AS u WHERE s.id_unid_superior = u.id";
        
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
    
    function recuperaSiglaUnidade(conexao $conn) {
        $query = "SELECT s.id AS id, s.sigla AS sigla, s.descricao AS descricao, u.sigla AS sigla2 FROM subunidade AS s, unidade AS u WHERE s.id_unid_superior = u.id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $sigla2 = $row['sigla2'];
                return $sigla2;  
            }
        } else {
            echo "0 results";
        }      
    }
    
    function recuperaSiglaSubunidade(conexao $conn) {
        $query = "SELECT s.id AS id, s.sigla AS sigla, s.descricao AS descricao, u.sigla AS sigla2 FROM subunidade AS s, unidade AS u WHERE s.id_unid_superior = u.id";
        
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
                                <form name="formsubunidade1" action="../controller/SubunidadeController.php" method="POST">
                                <button type="submit" name="editar1" value="" class="btn btn-primary btn-xs">Editar</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                echo        '<td align="center">
                                <form name="formsubunidade2" action="../controller/SubunidadeController.php" method="POST">
                                <button type="submit" name="excluir" value="" class="btn btn-danger btn-xs">Excluir</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                                    
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
                $id = $row["id"];
                $_SESSION['idselect'] = $id;
                echo '<option>'. $row["sigla"]. '</option>';
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
