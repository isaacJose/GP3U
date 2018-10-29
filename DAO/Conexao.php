<?php
//done
class conexao {

    public function conecta() {
        
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dtbs = "sigep";
        $port = "3306";

        $conn = new mysqli($host, $user, $pass, $dtbs, $port);
        $conn->set_charset("utf8");
        if (!$conn) {
            die('Nao foi possível realizar a conexão ao BD, erro: ' . mysqli_connect_error());
        }
        return $conn;
    }
}
