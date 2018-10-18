<?php

class Item {
    
    public $id, $serial, $modelo, $estoque, $estoque_danificado, $situacao, $validade, $observacoes, $id_subunidade, $id_tipo_item, $id_fabricante;
    
    function getId() {
        return $this->id;
    }

    function getSerial() {
        return $this->serial;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getEstoque() {
        return $this->estoque;
    }

    function getEstoque_danificado() {
        return $this->estoque_danificado;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function getValidade() {
        return $this->validade;
    }

    function getObservacoes() {
        return $this->observacoes;
    }

    function getId_subunidade() {
        return $this->id_subunidade;
    }

    function getId_tipo_item() {
        return $this->id_tipo_item;
    }

    function getId_fabricante() {
        return $this->id_fabricante;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSerial($serial) {
        $this->serial = $serial;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setEstoque($estoque) {
        $this->estoque = $estoque;
    }

    function setEstoque_danificado($estoque_danificado) {
        $this->estoque_danificado = $estoque_danificado;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function setValidade($validade) {
        $this->validade = $validade;
    }

    function setObservacoes($observacoes) {
        $this->observacoes = $observacoes;
    }

    function setId_subunidade($id_subunidade) {
        $this->id_subunidade = $id_subunidade;
    }

    function setId_tipo_item($id_tipo_item) {
        $this->id_tipo_item = $id_tipo_item;
    }

    function setId_fabricante($id_fabricante) {
        $this->id_fabricante = $id_fabricante;
    }
}
