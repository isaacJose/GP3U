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