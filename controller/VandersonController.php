<?php
if(!isset($_SESSION)){
    session_start();
}

include_once '../DAO/ItemDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Item.php';

$json = file_get_contents('php://input');

$resultado = json_decode($json);

var_dump($resultado);
echo ("<script>console.log('PHP: ".$resultado."</script>");

$conexao = new Conexao();

$despachante = $_SESSION['nome_funcional'];
/*
$operadorDao = new OperadorDao();
$idDespachante = $operadorDao->recuperaId($conexao, $despachante);

$cautela = new Cautela();
$cautela->setPermanente($permanente);
$cautela->setIdPolicial($idPolicial);
$cautela->setIdDespachante($idDespachante);
$cautelaDao = new CautelaDao();
$cautelaDao->adiciona($conexao, $cautela);
*/