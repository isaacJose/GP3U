<?php
// session_start();
require_once "../controller/Uteis.php";

//done
class LogAcessoDao
{

    //done
    public function lista(conexao $conn)
    {
        $query = "SELECT matricula, nomedoacesso, horalogin, horalogout, datalogin, datalogout from logacesso";
        $result = mysqli_query($conn->conecta(), $query);

        if (mysqli_num_rows($result) > 0) {
            //while($row = mysqli_fetch_assoc($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                $uteis = new Uteis();
                $stringModal = $uteis->sanitizeString($row["nomedoacesso"]);
                echo '<td>' . $row["matricula"] . '</td>';
                echo '<td>' . $row["nomedoacesso"] . '</td>';
                echo '<td>' . $row["datalogin"] . '</td>';
                echo '<td>' . $row["horalogin"] . '</td>';
                echo '<td>' . $row["datalogout"] . '</td>';
                echo '<td>' . $row["horalogout"] . '</td>';
                        }
        } else {
            echo "0 results";
        }
    }
}
