<?php

use Symfony\Component\VarDumper\VarDumper;

include_once '../DAO/InspecaoDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Inspecao.php';

class InspecaoController { //Função que lista na tabela os dados das inpeções, situaçao - terminada;
    
    public function listaInspecao() {
        
        $conexao = new conexao(); //Instanciando conexão;
        $inspecaoDao = new InspecaoDao(); //Chamada da função na DAO;
        $inspecaoDao->lista($conexao);
    }
    //Função que insere uma nova inspeçao no BD, situação - fazendo;
    public function insereInspecao() {
        //recuperaçao de dados via input's;
        $dataUltima = filter_input(INPUT_POST,"dataUltima",FILTER_SANITIZE_STRING);
        $dataProxima = date("Y/m/d",strtotime(date("Y-m-d", strtotime($dataUltima)) . " +3 month")); //somando três meses a dataUltima
        $situacao = filter_input(INPUT_POST,"situacao",FILTER_SANITIZE_STRING);
        $idCautela = filter_input(INPUT_POST,"idCautela",FILTER_SANITIZE_STRING);
        
        $conexao = new conexao();   //Instanciando conexão;
        
        //Setando infos e add;
        $inspecao = new inspecao();
        $inspecao->setDataUltima($dataUltima);
        $inspecao->setDataProxima($dataProxima);
        $inspecao->setSituacao($situacao);
        $inspecao->setIdCautela($idCautela);
        $inspecaoDao = new InspecaoDao();
        $inspecaoDao->adiciona($conexao, $inspecao);      
    }
    
    public function excluiInspecao() { //Função para excluir inpeções do BD, situação - fazendo
        //recuperaçao de dados via input's;
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        //Instanciando conexão;
        $conexao = new conexao();
        //Setando infos e add;
        $inspecao = new inspecao();
        $inspecao->setId($id);
        $inspecaoDao = new inspecaoDao();
        $inspecaoDao->exclui($conexao, $inspecao);
    }
    //Função que edita os dados das inpeções, situação - fazendo;
    public function editaInspecao() {
        //Instanciando conexão;
        $conexao = new conexao();
        //recuperação de dados via input's
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);//vindo do input hidden.
        $dataUltima = filter_input(INPUT_POST,"dataUltima",FILTER_SANITIZE_STRING);
        $dataProxima = date("Y/m/d",strtotime(date("Y-m-d", strtotime($dataUltima)) . " +3 month")); //somando três meses a dataUltima
        $situacao = filter_input(INPUT_POST,"situacao",FILTER_SANITIZE_STRING);
        $idCautela = filter_input(INPUT_POST,"idCautela",FILTER_SANITIZE_STRING);
        //Setando valores;    
        $inspecao = new inspecao();        
        $inspecao->setId($id);
        $inspecao->setDataUltima($dataUltima);
        $inspecao->setDataProxima($dataProxima);
        $inspecao->setSituacao($situacao);
        $inspecao->setIdCautela($idCautela);
        
        $inspecaoDao = new InspecaoDao();
        $inspecaoDao->edita($conexao, $inspecao);
    }

    public function renovaInspecao() {
        //Instanciando conexão;
        $conexao = new conexao();
        //recuperação de dados via input's
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);//vindo do input hidden.        
        $inspecaoDao = new InspecaoDao();
        $inspecaoDao->renova($conexao, $id);
    }
}

//Form quando solicitado via input tem seu tratamento realizado aqui 
$inspecao = new InspecaoController();

$cadastrar = filter_input(INPUT_POST,"cadastrar",FILTER_SANITIZE_STRING);//Verifica o acionamento do botao cadastrar.
$editar = filter_input(INPUT_POST,"editar",FILTER_SANITIZE_STRING);//Verifica o acionamento do botao editar.
$excluir = filter_input(INPUT_POST,"excluir",FILTER_SANITIZE_STRING);//Verifica o acionamento do botao excluir.
$renovar = filter_input(INPUT_POST,"renovar",FILTER_SANITIZE_STRING);//Verifica o acionamento do botao excluir.

if (isset($cadastrar)) {
    $inspecao->insereInspecao();
    header("Location: ../view/InspecaoView.php");
}

if (isset($excluir)) {
    $inspecao->excluiInspecao();
    header("Location: ../view/InspecaoView.php");
}

if(isset($editar)){
    $inspecao->editaInspecao();
    header("Location: ../view/InspecaoView.php");
}

if(isset($renovar)){
    $inspecao->renovaInspecao();
    header("Location: ../view/InspecaoView.php");
}