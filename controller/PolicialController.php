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
        var_dump($nome);
        $patente = filter_input(INPUT_POST,"patente",FILTER_SANITIZE_STRING);
        var_dump($patente);
        $nome_funcional = filter_input(INPUT_POST,"nome_funcional",FILTER_SANITIZE_STRING);
        var_dump($nome_funcional);
        $matricula = filter_input(INPUT_POST,"matricula",FILTER_SANITIZE_STRING);
        var_dump($matricula);
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING);
        var_dump($email);
        $situacao = filter_input(INPUT_POST,"situacao",FILTER_SANITIZE_STRING);
        var_dump($situacao);
        $subunidade = filter_input(INPUT_POST,"subunidade",FILTER_SANITIZE_STRING);
        var_dump($subunidade);
        $id = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_STRING);
        var_dump($id);

        $conexao = new conexao();

        $idSub = PolicialDao::recuperaIdSubunidade2($conexao, $subunidade);
        var_dump($idSub);
        $policial = new Policial();
        $policial->setId($id);
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

        $nome = filter_input(INPUT_POST,"nome",FILTER_SANITIZE_STRING);
        //var_dump($nome);
        $patente = filter_input(INPUT_POST,"patente",FILTER_SANITIZE_STRING);
        //var_dump($patente);
        $nome_funcional = filter_input(INPUT_POST,"nome_funcional",FILTER_SANITIZE_STRING);
        //var_dump($nome_funcional);
        $matricula = filter_input(INPUT_POST,"matricula",FILTER_SANITIZE_STRING);
        var_dump($matricula);
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING);
        //var_dump($email);
        $situacao = filter_input(INPUT_POST,"situacao",FILTER_SANITIZE_STRING);
        //var_dump($situacao);
        $subunidade = filter_input(INPUT_POST,"subunidade",FILTER_SANITIZE_STRING);
        //var_dump($subunidade);
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        //var_dump($id); 
        
        $conexao = new conexao();       
        $policial = new Policial();
        $idSub = PolicialDao::recuperaIdSubunidade2($conexao, $subunidade);
        $policial->setId($id);
        $policial->setNome($nome);
        $policial->setGraduacao($patente);
        $policial->setNome_funcional($nome_funcional);
        $policial->setMatricula($matricula);
        $policial->setEmail($email);
        $policial->setSituacao($situacao);
        $policial->setId_subunidade($idSub);
        $policialDao = new PolicialDao();
        $policialDao->edita($conexao, $policial);
    }
}

//futuramente criar o .php de chamada com as infos abaixo

$policial = new PolicialController();

// se apertou casdastar, $cadastrar recebe $_POST['cadastrar(name do input)']...
$cadastrar = filter_input(INPUT_POST,"cadastrar",FILTER_SANITIZE_STRING);
$excluir = filter_input(INPUT_POST,"excluir",FILTER_SANITIZE_STRING);
$editar = filter_input(INPUT_POST,"editar",FILTER_SANITIZE_STRING);

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
    header("Location: ../view/PolicialView.php");
}
