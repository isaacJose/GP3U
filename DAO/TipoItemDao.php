<?php
if(!isset($_SESSION)){
    session_start();
}

//done
class TipoItemDao{    
    
    function listaSelect(conexao $conn) {
        $query = "SELECT id, descricao FROM tipo_item ORDER BY descricao";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value='. $row["id"].'>'. $row["descricao"].'</option>';

            }
        } else {
            echo "0 results";
        }
    }

    //Função para selecionar o tipo item que o usuário tinha anteriormente
    function listaSelectEdicao(conexao $conn, $idItem) {
        $query = "SELECT id, descricao FROM tipo_item";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row["id"] === $idItem){
                    echo '<option selected="selected" value='. $row["id"].'>'. $row["descricao"].'</option>';
                }
                else{
                    echo '<option value='. $row["id"].'>'. $row["descricao"].'</option>';
                }

            }
        } else {
            echo "0 results";
        }
    }


    function recuperaId(conexao $conn) {
        $query = "SELECT id FROM tipo_item";
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
        $query = "SELECT descricao from tipo_item WHERE id= ".$id;      
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
    
}