<?php

include_once '../DAO/LoginDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Login.php';

class LoginController {

    //doing
    public function recuperaLogin() {

        //captura o email do form de login
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING);
        //$senha = filter_input(INPUT_POST,"senha",FILTER_SANITIZE_STRING);
        //exibe o dado capturado
        //var_dump($_POST);

        
        
        //instância do objeto login
        $login = new LoginModel();
        //seta no objeto o atributo login
        $login->setEmail($email);
        //$login->setEmail($senha);

        //instância para estabelecer conexão com o banco de dados
        $conexao = new conexao();
        //instância de acesso ao banco de dados pelo DAO
        $loginDao = new LoginDao();
        //chamada da funcao que recupera o nome_funcional através do email passado como parâmetro
        $emailrecebido = $loginDao->recuperaNomeByEmail($conexao, $email);

        echo $emailrecebido;

        //return $emailrecebido;
    }    
}

$login = new LoginlController();

$entrar = filter_input(INPUT_POST,"Entrar",FILTER_SANITIZE_STRING);

if (isset($entrar)) {
    //$policial->inserePolicial();
    header("Location: ../view/PrincipalView.php");
}