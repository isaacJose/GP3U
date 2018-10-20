<?php
if(!isset($_SESSION)){
    session_start();
}

require_once '../DAO/Conexao.php';
require_once '../DAO/SubunidadeDao.php';
require_once '../model/Subunidade.php';

class SubunidadeController {
    //done
    public function insereSubunidade() {
        $unidade = filter_input(INPUT_POST,"unidade",FILTER_SANITIZE_STRING);
        var_dump($unidade);
        $descricao = filter_input(INPUT_POST,"descricao",FILTER_SANITIZE_STRING);
        var_dump($descricao);
        $sigla = filter_input(INPUT_POST,"sigla",FILTER_SANITIZE_STRING);
        var_dump($sigla);   
        
        $conexao = new conexao();

        $idSup = subunidadeDao::recuperaIdSuperior($conexao, $unidade);
        var_dump($idSup);   

        $subunidade = new subunidade();
        $subunidade->setSigla($sigla);
        $subunidade->setDescricao($descricao);
        $subunidade->setUnidadeSuperior($idSup);
        $subunidadeDao = new SubunidadeDao();
        $subunidadeDao->adiciona($conexao, $subunidade);      
    }

    //done
    public function listaSubunidade() {
        $conexao = new conexao();
        $subunidadeDao = new SubunidadeDao();
        $subunidadeDao->lista($conexao);
    }
    //done
    public function listaOptions() {
        $conexao = new conexao();
        $subunidadeDao = new SubunidadeDao();
        $subunidadeDao->listaSelect($conexao);
    }
    //done
    public function excluiSubunidade() {
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        $conexao = new conexao();
        $subunidade = new subunidade();
        $subunidade->setId($id);
        $subunidadeDao = new subunidadeDao();
        $subunidadeDao->exclui($conexao, $subunidade);
        unset($id);
    }
    
    public function editaSubunidade() {
        if (isset($_POST['descricao']))
            $descricao = $_POST['descricao'];
        if (isset($_POST['sigla']))
            $sigla = $_POST['sigla'];
        $unidadeSuperior = $_SESSION['idselect'];
        $conexao = new conexao();
        $subunidade = new subunidade();
        $id = subunidadeDao::recuperaId($conexao);
        $subunidade->setId($id);
        $subunidade->setDescricao($descricao);
        $subunidade->setSigla($sigla);
        $subunidade->setUnidadeSuperior($unidadeSuperior);
        $subunidadeDao = new SubunidadeDao();
        $subunidadeDao->edita($conexao, $subunidade);
        unset($_SESSION);
    }
}

$subunidade = new SubunidadeController();

if (isset($_POST['cadastrar']))
    $cadastrar = $_POST['cadastrar'];

if (isset($_POST['excluir']))
    $excluir = $_POST['excluir'];

if (isset($_POST['editar1']))
    $editar1 = $_POST['editar1'];

if (isset($_POST['editar2']))
    $editar2 = $_POST['editar2'];


if (isset($cadastrar)) {
    $subunidade->insereSubunidade();
    header("Location: ../view/SubunidadeView.php");
}

if (isset($excluir)) {
    $subunidade->excluiSubunidade();
    header("Location: ../view/SubunidadeView.php");
}

if(isset($editar1)){
    header("Location: ../view/SubunidadeFormEditar.php");
}

if(isset($editar2)){
    $subunidade->editaSubunidade();
    header("Location: ../view/SubunidadeFormListar.php");
}