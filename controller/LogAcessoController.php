<?php

include_once '../DAO/LogAcessoDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/LogAcesso.php';

class LogAcessoController {
    //doing
    public function listaLogs() {
        $conexao = new conexao();
        $LogAcessoDao = new LogAcessoDao();
        $LogAcessoDao->lista($conexao);
    }
}