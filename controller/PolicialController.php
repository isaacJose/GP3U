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
        //recuperando os dados do formulário
        $nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_STRING);
        $patente = filter_input(INPUT_POST,"patente",FILTER_SANITIZE_STRING);
        $nome_funcional = filter_input(INPUT_POST,"nome_funcional",FILTER_SANITIZE_STRING);
        $matricula = filter_input(INPUT_POST,"matricula",FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING);
        $situacao = filter_input(INPUT_POST,"situacao",FILTER_SANITIZE_STRING);
        $subunidade = filter_input(INPUT_POST,"subunidade",FILTER_SANITIZE_STRING);
        
        $conexao = new conexao();

        $idSub = PolicialDao::recuperaIdSubunidade($conexao, $subunidade);
        $policial = new Policial();
        $policial->setNome($nome);
        $policial->setGraduacao($patente);
        $policial->setNome_funcional($nome_funcional);
        $policial->setMatricula($matricula);
        $policial->setEmail($email);
        $policial->setSituacao($situacao);
        $policial->setId_subunidade($idSub);
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

// se apertou casdastar, $cadastrar recebe $_POST['cadastrar(name do input)']
$cadastrar = filter_input(INPUT_POST,"cadastrar",FILTER_SANITIZE_STRING);

if (isset($_POST['excluir']))
    $excluir = $_POST['excluir'];

if (isset($_POST['editar']))
    $editar = $_POST['editar'];

if (isset($cadastrar)) {
    $policial->inserePolicial();
    header("Location: ../view/PolicialView.php");
}

if (isset($excluir)) {
    $policial->excluiPolicial();
    header("Location: ../view/PolicialView.php");
}

if (isset($editar)) {
    $policial->editaPolicial();
    header("Location: ../view/PolicialFormListar.php");
}
