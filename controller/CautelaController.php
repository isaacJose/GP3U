<?php
include_once '../DAO/CautelaDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Cautela.php';

class CautelaController {
    //funções
    public function listaCautela() {
        $conexao = new conexao();
        $cautelaDao = new CautelaDao();
        $cautelaDao->lista($conexao);
    }

    public function listaCautelaItem($id) {
        $conexao = new conexao();
        $cautelaDao = new CautelaDao();
        $cautelaDao->listaCautelaItemDao($conexao, $id);
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

        //$permanente = filter_input(INPUT_POST,"permanente",FILTER_SANITIZE_STRING);
        $permanente = 1;
        //var_dump($permanente);
        //Ao realizar o cadastro, a cautela fica como aberta automaticamente, ao ser finalizada a cautela, o valor sera atualizado para 0.
        $aberta = 1;
        //var_dump($aberta);
        //somente se a cautela for temporaria.
        $vencimento = filter_input(INPUT_POST,"vencimento",FILTER_SANITIZE_STRING);
        //var_dump($vencimento);
        //sera feito com update inserindo a função NOW(), no proprio sql do campo em questao.
        $dataEntrega = filter_input(INPUT_POST,"dataEntrega",FILTER_SANITIZE_STRING);
        //var_dump($dataEntrega);
        $idPolicial = filter_input(INPUT_POST,"idPolicial",FILTER_SANITIZE_STRING);
        //var_dump($idPolicial);
        //pegará o valor da session do operador logado;
        $despachante = $_SESSION['nome_funcional'];
        //var_dump($despachante);
        $idDespachante = CautelaDao::recuperaIdOperador($conexao, $despachante);
        //var_dump($idDespachante);
        //Realizado da mesma forma do anterior, com a diferença que será feito por um update via sql, sendo cadastrado o usuario atualmente logado no sistema.
        $idRecebedor = $idDespachante;
        //var_dump($idRecebedor);

        $cautela = new Cautela();
        $cautela->setPermanente($permanente);
        $cautela->setAberta($aberta);
        $cautela->setVencimento($vencimento);
        $cautela->setDataEntrega($dataEntrega);
        $cautela->setIdPolicial($idPolicial);
        $cautela->setIdDespachante($idDespachante);
        $cautela->setIdRecebedor($idRecebedor);
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
    //header("Location: ../view/CautelaView.php");
}

if (isset($excluir)) {
    $cautela->excluiCautela();
    header("Location: ../view/CautelaView.php");
}

if(isset($editar)){
    $cautela->editaSubunidade();
    header("Location: ../view/SubunidadeView.php");
}
