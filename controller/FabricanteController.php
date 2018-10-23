<?php
if(!isset($_SESSION)){
    session_start();
}

require_once '../DAO/FabricanteDao.php';
require_once '../DAO/Conexao.php';

//done
class FabricanteController {
    
    public function listaOptions() {
        $conexao = new conexao();
        $fabricanteDao = new FabricanteDao();
        $fabricanteDao->listaSelect($conexao);
    }
    
    public function listaOptionsEdicao($id) {
        $conexao = new conexao();
        $fabricanteDao = new FabricanteDao();
        $fabricanteDao->listaSelectEdicao($conexao, $id);
    }
}
 