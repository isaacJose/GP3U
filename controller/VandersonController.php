<?php
include_once '../DAO/ItemDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Item.php';

$serial = $_POST['serialAjax'];
$quantidade = $_POST['quantidadeAjax'];

$conexao = new Conexao();
$itemDAO = new ItemDao();

$itemEncontrado = $itemDAO->getBySerialForCautela($conexao, $serial, $quantidade);


?>