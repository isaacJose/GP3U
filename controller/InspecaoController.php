<?php

class InspecaoController {
    //Função que lista na tabela os dados das inpeções, situaçao - terminada;
    public function listaInspecao() {
        //Instanciando conexão;
        $conexao = new conexao();
        //Chamada da função na DAO;
        $inspecaoDao = new InspecaoDao();
        $inspecaoDao->lista($conexao);
    }
    //Função que insere uma nova inspeçao no BD, situação - fazendo;
    public function insereInspecao() {
        //recuperaçao de dados via input's;
        $dataUltima = filter_input(INPUT_POST,"dataUltima",FILTER_SANITIZE_STRING);
        $dataProxima = filter_input(INPUT_POST,"dataProxima",FILTER_SANITIZE_STRING);
        $situacao = filter_input(INPUT_POST,"situacao",FILTER_SANITIZE_STRING);
        $idCautela = filter_input(INPUT_POST,"idCautela",FILTER_SANITIZE_STRING);
        //Instanciando conexão;
        $conexao = new conexao();  
        //Setando infos e add;
        $inspecao = new inspecao();
        $inspecao->setDataUltima($dataUltima);
        $inspecao->setDataProxima($dataProxima);
        $inspecao->setSituacao($situacao);
        $inspecao->setIdCautela($idCautela);
        $inspecaoDao = new InspecaoDao();
        $inspecaoDao->adiciona($conexao, $inspecao);      
    }
    //Função para excluir inpeções do BD, situação - fazendo
    public function excluiInspecao() {
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
        $dataProxima = filter_input(INPUT_POST,"dataProxima",FILTER_SANITIZE_STRING);
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
}
//`id`, `dataUltima`, `dataProxima`, `situacao`, `idCautela`

$inspecao = new InspecaoController();

$cadastrar = filter_input(INPUT_POST,"cadastrar",FILTER_SANITIZE_STRING);//Verifica o acionamento do botao cadastrar.
$editar = filter_input(INPUT_POST,"editar",FILTER_SANITIZE_STRING);//Verifica o acionamento do botao editar.
$excluir = filter_input(INPUT_POST,"excluir",FILTER_SANITIZE_STRING);//Verifica o acionamento do botao excluir.

if (isset($cadastrar)) {
    $inspecao->insereInspecao();
    header("Location: ../view/SubunidadeView.php");
}

if (isset($excluir)) {
    $inspecao->excluiInspecao();
    header("Location: ../view/SubunidadeView.php");
}

if(isset($editar)){
    $inspecao->editaInspecao();
    header("Location: ../view/SubunidadeView.php");
}