<?php


include_once '../DAO/PolicialDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Policial.php';

class PolicialController {
    
    //done
    public function listaOptions() {
        $conexao = new conexao();
        $policialDao = new PolicialDao();
        $policialDao->listaSelect($conexao);
    }
    //done
    public function inserePolicial() {
        if (isset($_POST['nome']))//ok
            $nome = $_POST['nome'];
        if (isset($_POST['patente']))//ok
            $patente = $_POST['patente'];
        if (isset($_POST['nome_funcional']))//ok
            $nome_funcional = $_POST['nome_funcional'];
        if (isset($_POST['matricula']))//ok
            $matricula = $_POST['matricula'];
        if (isset($_POST['email']))//ok
            $email = $_POST['email'];
        if (isset($_POST['situacao']))//ok
            $situacao = $_POST['situacao'];
        if (isset($_POST['subunidade']))//ok
            $subunidade = $_POST['subunidade'];
        
        $conexao = new conexao();
        $policial = new Policial();
        $policial->setNome($nome);
        $policial->setGraduacao($patente);
        $policial->setNome_funcional($nome_funcional);
        $policial->setMatricula($matricula);
        $policial->setEmail($email);
        $policial->setSituacao($situacao);
        $policial->setId_subunidade($subunidade);
        $policialDao = new PolicialDao();
        $policialDao->adiciona($conexao, $policial);
    }
    //done
    public function listaPolicial() {
        $conexao = new conexao();
        $policialDao = new PolicialDao();
        $policialDao->lista($conexao);
    }
    //done
    public function excluiPolicial() {
        $id = $_POST['id'];
        $conexao = new conexao();
        $policial = new Policial();
        $policial->setId($id);
        $policialDao = new PolicialDao();
        $policialDao->exclui($conexao, $policial);
    }
    
    public function editaPolicial() {
        
        if (isset($_POST['nome']))//ok
            $nome = $_POST['nome'];
        if (isset($_POST['patente']))//ok
            $patente = $_POST['patente'];
        if (isset($_POST['nome_funcional']))//ok
            $nome_funcional = $_POST['nome_funcional'];
        if (isset($_POST['matricula']))//ok
            $matricula = $_POST['matricula'];
        if (isset($_POST['email']))//ok
            $email = $_POST['email'];
        if (isset($_POST['situacao']))//ok
            $situacao = $_POST['situacao'];
        if (isset($_POST['subunidade']))//ok
            $subunidade = $_POST['subunidade'];     
        
        $conexao = new conexao();       
        $policial = new Policial();
        $id = PolicialDao::recuperaId($conexao, $policial);
        $policial->setId($id);
        $policial->setNome($nome);
        $policial->setGraduacao($patente);
        $policial->setNome_funcional($nome_funcional);
        $policial->setMatricula($matricula);
        $policial->setEmail($email);
        $policial->setSituacao($situacao);
        $policial->setId_subunidade($subunidade);
        $policialDao = new PolicialDao();
        $policialDao->edita($conexao, $policial);
    }
}

$policial = new PolicialController();

if (isset($_POST['cadastrar']))
    $cadastrar = $_POST['cadastrar'];

if (isset($_POST['excluir']))
    $excluir = $_POST['excluir'];

if (isset($_POST['editar']))
    $editar = $_POST['editar'];

if (isset($cadastrar)) {
    $policial->inserePolicial();
    header("Location: ../view/PolicialViewListar.php");
}

if (isset($excluir)) {
    $policial->excluiPolicial();
    header("Location: ../view/PolicialFormListar.php");
}

if (isset($editar)) {
    $policial->editaPolicial();
    header("Location: ../view/PolicialFormListar.php");
}
