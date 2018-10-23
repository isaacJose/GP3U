<?php
if(!isset($_SESSION)){
    session_start();
}

//done
class FabricanteDao{    
    
    function listaSelect(conexao $conn) {
        $query = "SELECT id, descricao FROM fabricante";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                echo '<option value='. $row["id"].'>'. $row["descricao"].'</option>';

            }
        } else {
            echo "0 results";
        }
    }

    function listaSelectEdicao(conexao $conn, $idFabricante) {
        $query = "SELECT id, descricao FROM fabricante";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($idFabricante === $row["id"]){
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
        $query = "SELECT id FROM fabricante";
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
        $query = "SELECT descricao from fabricante WHERE id= ".$id;      
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