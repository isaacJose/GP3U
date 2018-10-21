<?php
 session_start();
//done
class PolicialDao {
    //done
    function adiciona(conexao $conn, policial $policial) {
        $query = "INSERT INTO policial(id, nome, graduacao, nome_funcional, matricula, email, situacao, id_subunidade) VALUES (NULL,'{$policial->getNome()}','{$policial->getGraduacao()}','{$policial->getNome_funcional()}','{$policial->getMatricula()}','{$policial->getEmail()}','{$policial->getSituacao()}','{$policial->getId_subunidade()}')";
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Novo cadastro realizado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }

    function recuperaSiglaSubunidade(conexao $conn, $subunidadeId){
        $query = "SELECT sigla FROM subunidade WHERE id = $subunidadeId";
        
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

    function recuperaPatente(conexao $conn, $id) {
        $query = "SELECT graduacao FROM policial WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $graduacao = $row['graduacao'];
                return $graduacao;  
            }
        } else {
            echo "0 results";
        }      
    }

    function recuperaNomeFuncional(conexao $conn, $id) {
        $query = "SELECT nome_funcional FROM policial WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $nome_funcional = $row['nome_funcional'];
                return $nome_funcional;  
            }
        } else {
            echo "0 results";
        }      
    }

    //done
    function listaSelect(conexao $conn) {
        $query = "SELECT * FROM subunidade";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option>'. $row["sigla"]. '</option>';
            }
        } else {
            echo "0 results";
        }
    }
    //done
    function lista(conexao $conn) {
        $query = "SELECT p.id AS id, p.nome AS nome, p.graduacao AS graduacao, p.nome_funcional AS nome_funcional, p.matricula AS matricula, p.email AS email, p.situacao AS situacao, p.id_subunidade AS id_subunidade, s.sigla AS sigla_subunidade FROM policial AS p, subunidade AS s WHERE p.id_subunidade = s.id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            //while($row = mysqli_fetch_assoc($result)) {  
            while($row = mysqli_fetch_assoc($result)) { 
                echo '<tr>';        
                    echo '<td>' . $row["nome"] . '</td>';
                    echo '<td>' . $row["graduacao"] . '</td>';
                    echo '<td>' . $row["matricula"] . '</td>';
                    echo '<td>' . $row["situacao"] . '</td>';
                    echo '<td>' . $row["sigla_subunidade"] . '</td>';
                    echo    '<td align="center">
                                <form name="formpolicial1" action="../view/PolicialViewEditar.php" method="POST">
                                    <button type="submit" name="editar1" value="" class="btn btn-primary btn-xs">Editar</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                    echo    '<td align="center">
                                <form name="formpolicial2" action="../controller/PolicialController.php" method="POST">
                                    <button type="submit" name="excluir" value="" class="btn btn-danger btn-xs">Excluir</button>
                                    <input type="hidden" name="id" value="'.$row["id"].'">
                                </form>
                            </td>';
                echo '</tr>';
                
            }
        } else {
            echo "0 results";
        }
        
    }
    //done
    function recuperaId(conexao $conn, Policial $policial) {
        $query = "SELECT id FROM policial WHERE matricula = '{$policial->getMatricula()}'";
        
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
    //done
    function recuperaNome(conexao $conn, $id) {
        $query = "SELECT nome FROM policial WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $nome = $row['nome'];
                return $nome;  
            }
        } else {
            echo "0 results";
        }      
    }

    //done
    function recuperaMatricula(conexao $conn, $id) {
        $query = "SELECT matricula FROM policial WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $matricula = $row['matricula'];
                return $matricula;  
            }
        } else {
            echo "0 results";
        }      
    }
    //done
    function recuperaEmail(conexao $conn, $id) {
        $query = "SELECT email FROM policial WHERE id = $id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $email = $row['email'];
                return $email;  
            }
        } else {
            echo "0 results";
        }      
    }
    //done
    function recuperaSituacao(conexao $conn, $id) {
        $query = "SELECT situacao FROM policial WHERE id = '$id'";
        
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
    //done
    function recuperaIdSubunidade(conexao $conn, $id) {
        $query = "SELECT id_subunidade FROM policial WHERE id = '$id'";
        
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

    function recuperaIdSubunidade2(conexao $conn, $sigla) {
        $query = "SELECT id FROM subunidade WHERE sigla = '$sigla'";
        
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
    //done
    function exclui(conexao $conn, Policial $policial) {
        $query = "DELETE FROM policial WHERE id = {$policial->getId()}";

        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
    //done
    function edita(conexao $conn, Policial $policial) {
        //$query = "UPDATE subunidade SET sigla='{$subunidade->getSigla()}',descricao='{$subunidade->getDescricao()}',id_unid_superior={$subunidade->getUnidadeSuperior()} WHERE id={$subunidade->getId()}";
        $query = "UPDATE policial SET nome='{$policial->getNome()}',graduacao='{$policial->getGraduacao()}',nome_funcional='{$policial->getNome_funcional()}',matricula='{$policial->getMatricula()}',email='{$policial->getEmail()}',situacao='{$policial->getSituacao()}',id_subunidade='{$policial->getId_subunidade()}' WHERE id = '{$policial->getId()}'";
        //$query = "UPDATE policial SET nome='{$policial->getNome()}',graduacao='{$policial->getGraduacao()}',nome_funcional='{$policial->getNome_funcional()}',matricula='{$policial->getMatricula()}',email='{$policial->getEmail()}',situacao='{$policial->getSituacao()}',id_subunidade='{$policial->getId_subunidade()}' WHERE id = '{$policial->getId()}'";
        if (mysqli_query($conn->conecta(), $query)) {
            echo "Registro editado com sucesso!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn->conecta());
        }
    }
}
