<?php

class LogAcesso
{
    public $id;
    public $nome;
    public $graduacao;
    public $nome_funcional;
    public $matricula;
    public $email;

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getGraduacao() {
        return $this->graduacao;
    }

    function getNome_funcional() {
        return $this->nome_funcional;
    }

    function getMatricula() {
        return $this->matricula;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setGraducao($graducao) {
        $this->graducao = $graducao;
    }

    function setNome_funcional($nome_funcional) {
        $this->nome_funcional = $nome_funcional;
    }

    function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    function setEmail($email) {
        $this->email = $email;
    }
}
