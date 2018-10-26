<?php
session_start();

class LoginDao {
    function recuperaNomeByEmail(conexao $conn, $email) {
        // Ex.: SELECT * FROM policial WHERE email = 'bruno@email.com';
        $query = "SELECT nome_funcional FROM policial WHERE email = $email";
        
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
}