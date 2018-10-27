<?php
//done
class conexao {

    public function conecta() {
        $conn = new mysqli('localhost', 'root', '', 'sigep', '3306');
        $conn->set_charset("utf8");
        if (!$conn) {
            die('Nao foi possível realizar a conexão ao BD, erro: ' . mysqli_connect_error());
        }
        return $conn;
    }
}
