<?php

class Policial {
    
public $id;
public $nome;
public $graduacao;
public $nome_funcional;
public $matricula;
public $email;
public $situacao;
public $id_subunidade;

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

function getSituacao() {
    return $this->situacao;
}

function getId_subunidade() {
    return $this->id_subunidade;
}

function setId($id) {
    $this->id = $id;
}

function setNome($nome) {
    $this->nome = $nome;
}

function setGraduacao($graduacao) {
    $this->graduacao = $graduacao;
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

function setSituacao($situacao) {
    $this->situacao = $situacao;
}

function setId_subunidade($id_subunidade) {
    $this->id_subunidade = $id_subunidade;
}


}
