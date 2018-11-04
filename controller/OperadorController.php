<?php

include_once '../DAO/OperadorDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Operador.php';

class OperadorController {
    //doing
    public function listaLogs() {
        $conexao = new conexao();
        $OperadorDao = new OperadorDao();
        $OperadorDao->lista($conexao);
    }
}