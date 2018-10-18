<?php

include_once '../DAO/ItemDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Item.php';

class ItemController {
    public function listaItem() {
        $conexao = new conexao();
        $itemDao = new ItemDao();
        $itemDao->lista($conexao);
    }
}
