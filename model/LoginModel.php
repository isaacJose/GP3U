<?php
class LoginModel {
    public $email;
    public $senha;

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($email) {
        $this->senha = $senha;
    }
}