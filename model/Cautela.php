<?php

class Cautela {
    public $id, $policial, $armamento, $quantidade, $tipo_cautela, $vencimento;
    
    function getId() {
        return $this->id;
    }

    function getPolicial() {
        return $this->policial;
    }

    function getArmamento() {
        return $this->armamento;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getTipo_cautela() {
        return $this->tipo_cautela;
    }

    function getVencimento() {
        return $this->vencimento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPolicial($policial) {
        $this->policial = $policial;
    }

    function setArmamento($armamento) {
        $this->armamento = $armamento;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setTipo_cautela($tipo_cautela) {
        $this->tipo_cautela = $tipo_cautela;
    }

    function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }


}
