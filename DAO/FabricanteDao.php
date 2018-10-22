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
<<<<<<< HEAD
                echo '<option value='. $row["id"].'>'. $row["descricao"].'</option>';
=======
                echo '<option value=' . $row["id"].'>'. $row["descricao"].'</option>';
>>>>>>> 510bfe77872e33c6b3c9c0adba9c62333139c19f
            }
        } else {
            echo "0 results";
        }
    }
    
}