<?php
if(!isset($_SESSION)){
    session_start();
}

//done
class TipoItemDao{    
    
    function listaSelect(conexao $conn) {
        $query = "SELECT id, descricao FROM tipo_item";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value=' . $row["id"].'>'. $row["descricao"].'</option>';
            }
        } else {
            echo "0 results";
        }
    }

    function recuperaId($descricao) {
        $query = "SELECT id from tipo_item ti where ti.descricao = $descricao";      
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
    
}