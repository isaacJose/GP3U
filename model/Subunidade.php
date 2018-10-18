<?php
//done
class subunidade {
    
    public $id;
    public $sigla;
    public $descricao;
    public $unidadeSuperior;    
    
    function getId() {
        return $this->id;
    }

    function getSigla() {
        return $this->sigla;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getUnidadeSuperior() {
        return $this->unidadeSuperior;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setUnidadeSuperior($unidadeSuperior) {
        $this->unidadeSuperior = $unidadeSuperior;
    }


}
