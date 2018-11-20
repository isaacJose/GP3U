<?php

use Symfony\Component\VarDumper\VarDumper;

include_once '../DAO/ItemDao.php';
include_once '../DAO/Conexao.php';
include_once '../model/Item.php';

class ItemController {
    
    public function listaItem() {
        $conexao = new conexao();
        $itemDao = new ItemDao();
        $itemDao->lista($conexao);
    }

    public function listaItemModal() {
        $conexao = new conexao();
        $itemDao = new ItemDao();
        $itemDao->listaModal($conexao);
    }

    public function listaItemTeste() {
        $conexao = new conexao();
        $itemDao = new ItemDao();
        $itemDao->listaTeste($conexao);
    }
    
    //done
    public function insereItem() {
       
       if (isset($_POST['serial']))
            $serial = $_POST['serial'];
        if (isset($_POST['modelo']))
            $modelo = $_POST['modelo'];
        if (isset($_POST['estoque']))
            $estoque = $_POST['estoque'];
        if (isset($_POST['estoque_danificado']))
            $estoque_danificado = $_POST['estoque_danificado'];
        if (isset($_POST['situacao']))
            $situacao = $_POST['situacao'];
        if (isset($_POST['validade']))
            $validade = $_POST['validade'];
        if (isset($_POST['observacoes']))
            $observacoes = $_POST['observacoes'];
        if (isset($_POST['id_subunidade']))
            $id_subunidade = $_POST['id_subunidade'];
        if (isset($_POST['id_tipo_item']))
            $id_tipo_item = $_POST['id_tipo_item'];
        if (isset($_POST['id_fabricante']))
            $id_fabricante = $_POST['id_fabricante'];
       
        $conexao = new conexao();
        $item = new Item();
        $item->setSerial($serial);
        $item->setModelo($modelo);
        $item->setEstoque($estoque);
        $item->setEstoque_danificado($estoque_danificado);
        $item->setSituacao($situacao);
        $item->setValidade($validade);
        $item->setObservacoes($observacoes);
        $item->setId_subunidade($id_subunidade);
        $item->setId_tipo_item($id_tipo_item);
        $item->setId_fabricante($id_fabricante);
        
        $itemDao = new ItemDao();
        $itemDao->adiciona($conexao, $item);
    }
    
    //done
    public function excluiItem() {
        $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
        $conexao = new conexao();
        $item = new Item();
        $item->setId($id);
        $itemDao = new ItemDao();
        $itemDao->exclui($conexao, $item);
        unset($id);
    }

    //done
    public function editaItem() {
        
        if (isset($_POST['id']))
            $id = $_POST['id'];
        if (isset($_POST['serial']))
            $serial = $_POST['serial'];
        if (isset($_POST['modelo']))
            $modelo = $_POST['modelo'];
        if (isset($_POST['estoque']))
            $estoque = $_POST['estoque'];
        if (isset($_POST['estoque_danificado']))
            $estoque_danificado = $_POST['estoque_danificado'];
        if (isset($_POST['situacao']))
            $situacao = $_POST['situacao'];
        if (isset($_POST['validade']))
            $validade = $_POST['validade'];
        if (isset($_POST['observacoes']))
            $observacoes = $_POST['observacoes'];
        if (isset($_POST['id_subunidade']))
            $id_subunidade = $_POST['id_subunidade'];
        if (isset($_POST['id_tipo_item']))
            $id_tipo_item = $_POST['id_tipo_item'];
        if (isset($_POST['id_fabricante']))
            $id_fabricante = $_POST['id_fabricante'];
       
        $conexao = new conexao();
        $item = new Item();
        $item->setId(intval($id));
        $item->setSerial($serial);
        $item->setModelo($modelo);
        $item->setEstoque(intval($estoque));
        $item->setEstoque_danificado(intval($estoque_danificado));
        $item->setSituacao($situacao);
        $item->setValidade($validade);
        $item->setObservacoes($observacoes);
        $item->setId_subunidade(intval($id_subunidade));
        $item->setId_tipo_item(intval($id_tipo_item));
        $item->setId_fabricante(intval($id_fabricante));
       
        $itemDao = new ItemDao();

        print_r($item);

        $itemDao->edita($conexao, $item);
    }
}

$item = new ItemController();

if (isset($_POST['cadastrar']))
    $cadastrar = $_POST['cadastrar'];
  
if (isset($_POST['excluir']))
    $excluir = $_POST['excluir'];

if (isset($_POST['editar']))
    $editar = $_POST['editar'];


if (isset($cadastrar)) {
    $item->insereItem();
    header("Location: ../view/ItemView.php");
}

if (isset($excluir)) {
    $item->excluiItem();
    header("Location: ../view/ItemView.php");
}

if (isset($editar)){
    $item->editaItem();
    header("Location: ../view/ItemView.php");
    
}