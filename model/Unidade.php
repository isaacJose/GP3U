<?php
class unidade {
    public $descricao;
    public $sigla;
    public $id;
    
    function getDescricao() {
        return $this->descricao;
    }

    function getSigla() {
        return $this->sigla;
    }

    function getId() {
        return $this->id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    function setId($id) {
        $this->id = $id;
    }
}
