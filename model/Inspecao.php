<?php

class Inspecao {
    
    public $id, $dataUltima, $dataProxima, $situacao, $idCautela;

    function getId() {
        return $this->id;
    }

    function getDataUltima() {
        return $this->dataUltima;
    }

    function getDataProxima() {
        return $this->dataProxima;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function getIdCautela() {
        return $this->idCautela;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDataUltima($dataUltima) {
        $this->dataUltima = $dataUltima;
    }

    function setDataProxima($dataProxima) {
        $this->dataProxima = $dataProxima;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function setIdCautela($idCautela) {
        $this->idCautela = $idCautela;
    }
}