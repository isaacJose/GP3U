<?php
if(!isset($_SESSION)){
    session_start();
}
//header('Content-Type:'."text/plain");
include_once '../DAO/ItemDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Item.php';

/*
$teste = array
(
    "0" => array(
        'idItem' => "3",
        'id_policial' => "1",
        'permanente' => "1",
        'quantidade' => "12"
    ),
    "1" => array(
        'idItem' => "4",
        'id_policial' => "1",
        'permanente' => "1",
        'quantidade' => "5"
    )
);

var_dump ($teste[0]);
echo $teste[0]['quantidade'];
*/

$host = "localhost";
$user = "root";
$pass = "";
$dtbs = "sigep";
$port = "3306";

$conn = new mysqli($host, $user, $pass, $dtbs, $port);
$conn->set_charset("utf8");

$permanente = $_POST['permanente'];
$id_policial = $_POST['id_policial'];
$id_item = $_POST['id_item'];
$quantidade = $_POST['quantidade'];
var_dump($teste);

$query = "INSERT INTO item_cautela
        (
            idItem, 
            quantidade
        ) 
        VALUES 
        (
            ".$id_item.",".$quantidade."
        )";
if (mysqli_query($conn, $query)) {
    echo "Novo cadastro realizado com sucesso!";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conexao->conecta());
}




$despachante = $_SESSION['nome_funcional'];
$operadorDao = new OperadorDao();
$idDespachante = $operadorDao->recuperaId($conexao, $despachante);

$cautela = new Cautela();
$cautela->setPermanente($resultado['permanente']);
$cautela->setIdPolicial($idPolicial);
$cautela->setIdDespachante($idDespachante);
$cautelaDao = new CautelaDao();
$cautelaDao->adiciona($conexao, $cautela);