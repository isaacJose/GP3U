<?php

class Cautela {
    public $id, $permanente, $aberta, $dataRetirada, $vencimento, $dataEntrega, $idPolicial, $idDespachante, $idRecebedor;
    
    
    function getId() {
        return $this->id;
    }

    function getPermanente() {
        return $this->permanente;
    }

    function getAberta() {
        return $this->aberta;
    }

    function getDataRetirada() {
        return $this->dataRetirada;
    }

    function getVencimento() {
        return $this->vencimento;
    }

    function getDataEntrega() {
        return $this->dataEntrega;
    }

    function getIdPolicial() {
        return $this->idPolicial;
    }

    function getIdDespachante() {
        return $this->idDespachante;
    }

    function getIdRecebedor() {
        return $this->idRecebedor;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPermanente($permanente) {
        $this->permanente = $permanente;
    }

    function setAberta($aberta) {
        $this->aberta = $aberta;
    }

    function setDataRetirada($dataRetirada) {
        $this->dataRetirada = $dataRetirada;
    }

    function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }

    function setDataEntrega($dataEntrega) {
        $this->dataEntrega = $dataEntrega;
    }

    function setIdPolicial($idPolicial) {
        $this->idPolicial = $idPolicial;
    }

    function setIdDespachante($idDespachante) {
        $this->idDespachante = $idDespachante;
    }

    function setIdRecebedor($idRecebedor) {
        $this->idRecebedor = $idRecebedor;
    }
}
