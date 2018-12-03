<?php
if(!isset($_SESSION)){
    session_start();
}
//header('Content-Type:'."text/plain");
include_once '../DAO/ItemDao.php';
include_once '../DAO/Conexao.php';
include_once '../DAO/OperadorDao.php';
include_once '../model/Item.php';

$host = "localhost";
$user = "root";
$pass = "";
$dtbs = "sigep";
$port = "3306";

$conn = new mysqli($host, $user, $pass, $dtbs, $port);
$conn->set_charset("utf8");

$permanente = intval($_POST['permanente']);
$id_policial = intval($_POST['id_policial']);
$id_item = intval($_POST['id_item']);
$quantidade = intval($_POST['quantidade']);
var_dump($teste);

$nomeDespachante = $_SESSION['nome_funcional'];
$idDespachante;
$query = "SELECT id FROM operador WHERE nome_funcional = '".$nomeDespachante."'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)) {
    $idDespachante = $row['id'];
}

$query = "INSERT INTO cautela
        (
            idItem, 
            quantidade,
            permanente,
            aberta,
            idPolicial,
            dataRetirada,
            vencimento,
            idDespachante
        ) 
        VALUES 
        (
            ".$id_item.",
            ".$quantidade.",
            ".$permanente.", 
            1, ".$id_policial.", 
            CURDATE(), 
            IF(".$permanente." = 1, NULL, DATE_ADD(CURDATE(), INTERVAL 1 DAY)), 
            ".$idDespachante."
        )";
if (mysqli_query($conn, $query)) {
    echo "Novo cadastro realizado com sucesso!";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conexao->conecta());
}