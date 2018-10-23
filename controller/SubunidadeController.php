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
        $descricao = filter_input(INPUT_POST,"descricao",FILTER_SANITIZE_STRING);
        $sigla = filter_input(INPUT_POST,"sigla",FILTER_SANITIZE_STRING); 
        
        $conexao = new conexao();

        $idSup = subunidadeDao::recuperaIdSuperior($conexao, $unidade);  

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

    public function listaOptionsEdicao($id) {
        $conexao = new conexao();
        $subunidadeDao = new SubunidadeDao();
        $subunidadeDao->listaSelectEdicao($conexao, $id);
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

        $conexao = new conexao();

        //recuperação de dados
        $descricao = filter_input(INPUT_POST,"descricao",FILTER_SANITIZE_STRING);
        $sigla = filter_input(INPUT_POST,"sigla",FILTER_SANITIZE_STRING);
        $unidade = filter_input(INPUT_POST,"unidade",FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);//vindo do input hidden.
        //$idSup = subunidadeDao::recuperaIdSuperior($conexao, $unidade);
        $idSup = $unidade;

        var_dump($id);
        echo $id." seria o id </br>";
        echo $descricao." - descrição</br>";
        echo $sigla." - sigla</br>";
        echo $unidade." - unidade</br>";
        echo $idSup." - id superior</br>";

        //onde acontece a mágica        
        $subunidade = new subunidade();        
        $subunidade->setId($id);
        $subunidade->setDescricao($descricao);
        $subunidade->setSigla($sigla);
        $subunidade->setUnidadeSuperior($idSup);
        $subunidadeDao = new SubunidadeDao();
        $subunidadeDao->edita($conexao, $subunidade);

        var_dump($subunidade);
    }
}

$subunidade = new SubunidadeController();

if (isset($_POST['cadastrar']))
    $cadastrar = $_POST['cadastrar'];

if (isset($_POST['excluir']))
    $excluir = $_POST['excluir'];

if (isset($_POST['editar']))
    $editar = $_POST['editar'];


if (isset($cadastrar)) {
    $subunidade->insereSubunidade();
    header("Location: ../view/SubunidadeView.php");
}

if (isset($excluir)) {
    $subunidade->excluiSubunidade();
    header("Location: ../view/SubunidadeView.php");
}

if(isset($editar)){
    $subunidade->editaSubunidade();
    header("Location: ../view/SubunidadeView.php");
}