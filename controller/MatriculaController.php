<?php

header('Content-Type:'."text/plain");

include_once '../DAO/ItemDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Item.php';

$matricula = $_POST['matricula'];

//$serial = 'TE78914AX';
//$quantidade = '1';

$host = "localhost";
$user = "root";
$pass = "";
$dtbs = "sigep";
$port = "3306";

$conn = new mysqli($host, $user, $pass, $dtbs, $port);
$conn->set_charset("utf8");

if (!$conn) {
    echo '[{"erro": "Não foi possível conectar ao banco."';
    echo '}]';
}
else{

    $query = "SELECT * FROM policial WHERE matricula = '$matricula'";
    $result = mysqli_query($conn, $query);
    $n = mysqli_num_rows($result);

    if (!$result) {
        echo '[{"erro": "Nenhum resultado encontrado."';
        echo '}]';
    }
    else{
        //mesclar resultados em um array
        for($i = 0; $i < $n ; $i++){
            $dados[] = mysqli_fetch_assoc($result);
        }
        echo json_encode($dados, JSON_PRETTY_PRINT);
    }            
}
?>