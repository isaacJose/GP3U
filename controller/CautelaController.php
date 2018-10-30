<?php
include_once '../DAO/CautelaDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Cautela.php';

class CautelaController {
    //funções
    public function listaCautela() {
        $conexao = new conexao();
        $policialDao = new CautelaDao();
        $policialDao->lista($conexao);
    }

    public function excluiCautela() {
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        $conexao = new conexao();
        $cautela = new Cautela();
        $cautela->setId($id);
        $cautelaDao = new CautelaDao();
        $cautelaDao->exclui($conexao, $cautela);
    }
}

$cautela = new CautelaController();

$cadastrar = filter_input(INPUT_POST,"cadastra",FILTER_SANITIZE_STRING);
$excluir = filter_input(INPUT_POST,"excluir",FILTER_SANITIZE_STRING);
$editar = filter_input(INPUT_POST,"editar",FILTER_SANITIZE_STRING);

if (isset($cadastrar)) {
    $cautela->insereSubunidade();
    header("Location: ../view/SubunidadeView.php");
}

if (isset($excluir)) {
    $cautela->excluiCautela();
    header("Location: ../view/CautelaView.php");
}

if(isset($editar)){
    $cautela->editaSubunidade();
    header("Location: ../view/SubunidadeView.php");
}
