<?php

class InspecaoController {
    //funções
    public function listaInspecao() {
        $conexao = new conexao();
        $inspecaoDao = new InspecaoDao();
        $inspecaoDao->lista($conexao);
    }
}