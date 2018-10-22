<?php
if(!isset($_SESSION)){
    session_start();
}

require_once '../DAO/TipoItemDao.php';
require_once '../DAO/Conexao.php';

//done
class TipoItemController {
    
    public function listaOptions() {
        $conexao = new conexao();
        $tipoItemDao = new TipoItemDao();
        $tipoItemDao->listaSelect($conexao);
    }
    
}
  
