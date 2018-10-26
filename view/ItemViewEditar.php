<?php
    include_once '../controller/ItemController.php';
    include_once '../controller/SubunidadeController.php';
    include_once '../controller/TipoItemController.php';
    include_once '../controller/FabricanteController.php';
    include_once '../DAO/ItemDao.php';
    include_once '../DAO/FabricanteDao.php';
    include_once '../DAO/tipoItemDao.php';
    include_once '../model/Item.php';
    include_once '../DAO/Conexao.php';
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIGEP</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom styles for icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  </head>

  <?php
    include 'includes/style/ItemViewEditar.html';
  ?>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="PrincipalView.php">SIGEP</a>      

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <a class="navbar-brand mr-1" href="">Bem vindo(a), User!</a>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="exit">
            <i class="material-icons" >menu</i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Configurações</a>
            <a class="dropdown-item" href="#">Operador</a>            
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#aboutModal">Sobre</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li>
          <div class="imagem">
          <img src="../img/sigeplogo.png">
          </div>                  
        </li>
        <li class="nav-item">
          <a class="nav-link" href="PrincipalView.php">
          <i class="material-icons">home</i>
            <span class="spanmenu">Principal</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ItemView.php">
          <i class="material-icons">star</i>
            <span class="spanmenu">Unidades</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="SubunidadeView.php">
          <i class="material-icons">star_border</i>
            <span class="spanmenu">Subunidades</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="PolicialView.php">
          <i class="material-icons">person</i>
            <span class="spanmenu">Policiais</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="ItemView.php">
          <i class="material-icons">storage</i>
            <span class="spanmenu">Itens</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="CautelaView.php">
          <i class="material-icons">attach_file</i>
            <span class="spanmenu">Cautelas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="InspecaoView.php">
          <i class="material-icons">find_in_page</i>
            <span class="spanmenu">Inspeções</span>
          </a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="../view/ItemView.php">Itens</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
            <!--<li class="breadcrumb-item active">Tables</li>-->
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="material-icons">grid_on</i>
              <span class="spanmenu">Item - Formulário de edição</span>
            </div>
            <div class="card-body">
              <form action="../controller/ItemController.php" method="post">
                <div class="row">

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Serial</label>
                      <?php
                        $conexao = new conexao();
                        $itemDao = new ItemDao();
                        $itemId = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
                        $serial = $itemDao->recuperaSerial($conexao, $itemId);
                        echo "<input id='serial' name='serial' class='form-control' value='$serial' required>";
                       ?>
                    </div>
                  </div>
                  
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Modelo</label>
                      <?php
                        
                        $itemDao = new ItemDao();
                        $modelo = $itemDao->recuperaModelo($conexao, $itemId);
                        echo "<input id='modelo' name='modelo' class='form-control' value='$modelo' required>";
                        echo '<input type="hidden" id="id" name="id" value="'.$itemId.'">';
                       ?>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Estoque</label>
                      <?php
                       
                        $itemDao = new ItemDao();
                        $estoque = $itemDao->recuperaEstoque($conexao, $itemId);
                        echo "<input id='estoque' name='estoque' class='form-control' value='$estoque' required>";
                       ?>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Estoque Danificado</label>
                      <?php
                        
                        $itemDao = new ItemDao();
                        $estoque_danificado = $itemDao->recuperaEstoque_danificado($conexao, $itemId);
                        echo "<input id='estoque_danificado' name='estoque_danificado' class='form-control' value='$estoque_danificado' required>";
                       ?>
                    </div>
                  </div>

                  <div class="col-lg-4">                                        
                    <div class="form-group">
                      <label>Situação</label>
                      <select id='situacao' name="situacao" class="form-control">
                        <?php
                        $select = 'selected="selected"';
                        $itemDao = new ItemDao();
                        $situacao = $itemDao->recuperaSituacao($conexao, $itemId);
                        //echo"<option selected>".$situacao."</option>";
                        ?>
                        <option <?php if($situacao === "Operacional") echo $select; ?> value="Operacional">Operacional</option> 
                        <option <?php if($situacao === "Danificado") echo $select; ?> value="Danificado">Danificado</option>
                        <option <?php if($situacao === "Manutenção") echo $select; ?> value="Manutenção">Manutenção</option>
                        <option <?php if($situacao === "Justiça") echo $select; ?> value="Justiça">Justiça</option>
                      </select>
                    </div>                                        
                  </div>

                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Validade</label>
                      <?php
                        
                        $itemDao = new ItemDao();
                        $validade = $itemDao->recuperaValidade($conexao, $itemId);
                        echo "<input type='date' id='validade' name='validade' class='form-control' value='$validade' required>";
                       ?>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Observações</label>
                      <?php
                        $itemDao = new ItemDao();
                        $observacoes = $itemDao->recuperaObservacoes($conexao, $itemId);
                        echo "<input id='observacoes' name='observacoes' class='form-control' value='$observacoes' required>";
                       ?>
                    </div>
                  </div>

                <div class="col-lg-2">
                    <div class="form-group">
                      <label>Subunidade</label>
                      <select id='id_subunidade' name='id_subunidade' class='form-control' required>
                        <?php
                        $ItemDao = new ItemDao();
                        $subunidadeDao = new SubunidadeDao();
                        $subunidadeId = $ItemDao->recuperaId_subunidade($conexao, $itemId);
                        $subunidade = $subunidadeDao->recuperaSiglaSubunidade($conexao, $subunidadeId);
                        //echo"<option selected>".$subunidade."</option>";
                        $opt = new SubunidadeController();
                        $opt->listaOptionsEdicao($subunidadeId);
                        ?>                                                                 
                      </select>
                    </div>
                  </div>

                <div class="col-lg-2">
                    <div class="form-group">
                      <label>Tipo Item</label>
                      <select id='id_tipo_item' name='id_tipo_item' class='form-control' required>
                        <?php
                        $ItemDao = new ItemDao(); 
                        $tipoItemDao = new TipoItemDao();
                        $tipoItemId = $ItemDao->recuperaId_tipo_item($conexao, $itemId);
                        $tipoItem = $tipoItemDao->recuperaDescricao($conexao, $tipoItemId);
                        //echo"<option selected>".$tipoItem."</option>";
                        $opt = new TipoItemController();
                        $opt->listaOptionsEdicao($tipoItemId);
                        ?>                                                                 
                      </select>
                    </div>
                  </div>

                <div class="col-lg-2">
                    <div class="form-group">
                      <label>Fabricante</label>
                      <select id='id_fabricante' name='id_fabricante' class='form-control' required>
                        <?php
                        $ItemDao = new ItemDao(); 
                        $fabricanteDao = new FabricanteDao();
                        $fabricanteId = $ItemDao->recuperaId_fabricante($conexao, $itemId);
                        $fabricante = $fabricanteDao->recuperaDescricao($conexao, $fabricanteId);
                        //echo"<option selected>".$fabricante."</option>"; //Selecionando assim, duplica no banco
                        $opt = new FabricanteController();
                        $opt->listaOptionsEdicao($fabricanteId);
                        ?>                                                                 
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <input type="submit"name="editar" value="Editar" class="btn btn-primary" >
                  </div>
                </div>
              </form> 
               
            </div>
          </div>
        </div>
        <br>

        
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © UFRN 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <?php
            include 'includes/logaout_in_navbar.html';
          ?>
        </div>
      </div>
    </div>

    <div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sobre</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" align="justify">O Sistema de Gerenciamento de Equipamentos para Proteção policial - SIGEP,
            foi desenvolvido como parte de requisito de nota para a disciplina de Gestão de Projetos por:
            <br/> <br/> Bruno Silva <br/>
            Isaac José <br/>
            Rodrigo Aggeu <br/>
            Vanderson Fábio <br/></div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script>

  </body>

</html>