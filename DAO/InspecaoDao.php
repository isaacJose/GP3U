<?php
//done
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
        $query = "SELECT i.id as idInspecao, c.id as idCautela, i.dataUltima as dataUltima, i.dataProxima as dataProxima, i.situacao as situacao
                  FROM inspecao i, cautela c
                  WHERE i.idCautela = c.id";
        
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            //while($row = mysqli_fetch_assoc($result)) {  
            while($row = mysqli_fetch_assoc($result)) { 
                echo '<tr>'; 
                
                    echo '<td>' . $row["idCautela"] . '</td>';       
                    echo '<td>' . $row["dataUltima"] . '</td>';
                    echo '<td>' . $row["dataProxima"] . '</td>';
                    echo '<td>' . $row["situacao"] . '</td>';
                                     
        }  
        } else {
            echo "0 results";
        }
        
    }
}