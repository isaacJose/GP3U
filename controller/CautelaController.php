<?php
include_once '../DAO/CautelaDao.php';
include_once '../DAO/OperadorDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Cautela.php';

class CautelaController {
    //funções
    public function listaCautela() {
        $conexao = new conexao();
        $cautelaDao = new CautelaDao();
        $cautelaDao->lista($conexao);
    }
    //função que lista os item dentro de uma cautela
    public function listaCautelaItem($id) {
        $conexao = new conexao();
        $cautelaDao = new CautelaDao();
        $cautelaDao->listaCautelaItemDao($conexao, $id);
    }
    //função que exclui item de uma cautela
    public function excluiCautelaItem($id) {
        $conexao = new conexao();
        $cautelaDao = new CautelaDao();
        $cautelaDao->excluiItemCautela($conexao, $cautela);
    }

    //done
    public function listaOptions() {
        $conexao = new conexao();
        $cautelaDao = new cautelaDao();
        $cautelaDao->listaSelect($conexao);
    }

    public function excluiCautela() {
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        $conexao = new conexao();
        $cautela = new Cautela();
        $cautela->setId($id);
        $cautelaDao = new CautelaDao();
        $cautelaDao->exclui($conexao, $cautela);
    }

    public function insereCautela() {

        $conexao = new conexao(); 

        $idPolicial = filter_input(INPUT_POST,"idPolicial",FILTER_SANITIZE_STRING);
        $permanente = filter_input(INPUT_POST,"permanente",FILTER_SANITIZE_STRING);
        //Ao realizar o cadastro, a cautela fica como aberta automaticamente, ao ser finalizada a cautela, o valor sera atualizado para 0.
        //$aberta = 1;
        $aberta = filter_input(INPUT_POST,"aberta",FILTER_SANITIZE_STRING);
        //somente se a cautela for temporaria.
        $dataRetirada = filter_input(INPUT_POST,"dataRetirada",FILTER_SANITIZE_STRING);
        $vencimento = filter_input(INPUT_POST,"vencimento",FILTER_SANITIZE_STRING);
        //sera feito com update inserindo a função NOW(), no proprio sql do campo em questao.
        $dataEntrega = filter_input(INPUT_POST,"dataEntrega",FILTER_SANITIZE_STRING);
        $despachante = $_SESSION['nome_funcional'];
        $operadorDao = new OperadorDao();
        $idDespachante = $operadorDao->recuperaId($conexao, $despachante);
        $idRecebedor = $idDespachante;

        $cautela = new Cautela();
        $cautela->setPermanente($permanente);
        $cautela->setAberta($aberta);
        $cautela->setVencimento($vencimento);
        $cautela->setDataEntrega($dataEntrega);
        $cautela->setDataRetirada($dataRetirada);        
        $cautela->setIdPolicial($idPolicial);
        $cautela->setIdDespachante($idDespachante);
        $cautela->setIdRecebedor($idRecebedor);
        var_dump($cautela);
        $cautelaDao = new CautelaDao();
        $cautelaDao->adiciona($conexao, $cautela);
    }

    public function editaCautela() {

        $permanente = filter_input(INPUT_POST,"permanente",FILTER_SANITIZE_STRING);
        //var_dump($permanente);
        $aberta = filter_input(INPUT_POST,"aberta",FILTER_SANITIZE_STRING);
        //var_dump($aberta);
        $dataRetirada = filter_input(INPUT_POST,"dataRetirada",FILTER_SANITIZE_STRING);
        //var_dump($dataRetirada);
        $vencimento = filter_input(INPUT_POST,"vencimento",FILTER_SANITIZE_STRING);
        //var_dump($vencimento);
        $dataEntrega = filter_input(INPUT_POST,"dataEntrega",FILTER_SANITIZE_STRING);
        //var_dump($dataEntrega);
        $idPolicial = filter_input(INPUT_POST,"idPolicial",FILTER_SANITIZE_STRING);
        //var_dump($idPolicial);
        $idDespachante = filter_input(INPUT_POST,"idDespachante",FILTER_SANITIZE_STRING);
        //var_dump($idDespachante);
        $idRecebedor = filter_input(INPUT_POST,"idRecebedor",FILTER_SANITIZE_STRING);
        //var_dump($idRecebedor);
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        //var_dump($id); 
        
        $conexao = new conexao();       
        $cautela = new Cautela();
        $cautela->setId($id);
        $cautela->setNome($nome);
        $cautela->setGraduacao($patente);
        $cautela->setNome_funcional($nome_funcional);
        $cautela->setMatricula($matricula);
        $cautela->setEmail($email);
        $cautela->setSituacao($situacao);
        $cautela->setId_subunidade($idSub);
        $cautelaDao = new CautelaDao();
        $cautelaDao->edita($conexao, $cautela);
    }
}

$cautela = new CautelaController();

$cadastrar = filter_input(INPUT_POST,"cadastrar",FILTER_SANITIZE_STRING);
$excluir = filter_input(INPUT_POST,"excluir",FILTER_SANITIZE_STRING);
$editar = filter_input(INPUT_POST,"editar",FILTER_SANITIZE_STRING);

if (isset($cadastrar)) {
    $cautela->insereCautela();
    header("Location: ../view/CautelaView.php");
}

if (isset($excluir)) {
    $cautela->excluiCautela();
    header("Location: ../view/CautelaView.php");
}

if(isset($editar)){
    $cautela->editaSubunidade();
    header("Location: ../view/SubunidadeView.php");
}
