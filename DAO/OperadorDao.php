<?php

require_once "../controller/Uteis.php";

class OperadorDao
{
    public function lista(conexao $conn)
    {
        $query = "SELECT matricula, nome, graduacao, nome_funcional, ativo, tipo FROM operador ORDER BY nome";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                $uteis = new Uteis();
                $stringModal = $uteis->sanitizeString($row["nome_funcional"]);
                echo '<td>' . $row["matricula"] . '</td>';
                echo '<td>' . $row["nome"] . '</td>';
                echo '<td>' . $row["graduacao"] . '</td>';
                echo '<td>' . $row["nome_funcional"] . '</td>';
                
                if ($row["ativo"] == 1){
                    echo '<td>' . 'Sim' . '</td>';
                } else {
                    echo '<td>' . 'Não' . '</td>';
                }
                
                echo '<td>' . $row["tipo"] . '</td>';
            }
        } else {
            echo "0 results";
        }
    }

    function recuperaId(conexao $conn, $nome_funcional) {
        $query = "SELECT o.id as id FROM operador o WHERE o.nome_funcional = '$nome_funcional'";
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
