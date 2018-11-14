<?php
session_start();
include '../validasessaoativa.php';
include '../validasessao.php';
include_once '../controller/CautelaController.php';
include_once '../controller/PolicialController.php';
include 'includes/header.html';
?>

  <?php
  include 'includes/style/CautelaViewCadastrar.html';
  ?>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="PrincipalView.php">SIGEP</a>

      

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <a class="navbar-brand mr-1" href="">Bem vindo(a), <?php echo ($_SESSION['nome_funcional']); ?></a>
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
            <a class="dropdown-item" href="#">Perfil</a>
            <a class="dropdown-item" href="OperadorView.php">Operador</a>            
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
          <a class="nav-link" href="UnidadeView.php">
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
        <li class="nav-item">
          <a class="nav-link" href="ItemView.php">
          <i class="material-icons">storage</i>
            <span class="spanmenu">Itens</span>
          </a>
        </li>
        <li class="nav-item active">
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
        <li class="nav-item">
          <a class="nav-link" href="LogAcessoView.php">
          <i class="material-icons">how_to_reg</i>
            <span class="spanmenu">Acessos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="OperadorView.php">
          <i class="material-icons">group</i>
            <span class="spanmenu">Operadores</span>
          </a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="../view/CautelaView.php">Cautelas</a>
            </li>
            <li class="breadcrumb-item active">Cadastrar</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="material-icons">grid_on</i>
              <span class="spanmenu">Cautela - Formulário de cadastro</span>
            </div>
            <div class="card-body">
              <form action="../controller/CautelaController.php" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-default">
                    <div class="row">   
                    
                    
                    <div class="col-lg-6">
                         <div class="form-group">
                            <label>Policial</label>
                            <select id="idPolicial" name="idPolicial" class="form-control" required>
                            <?php
                              $opt = new PolicialController();
                              $opt->listaOptions();
                            ?>
                            </select>
                        </div>
                      </div>
                    
                    <div class="col-lg-6">
                    <div class="form-group">
                      <label>Tipo de Cautela</label>
                      <select id="permanente" name="permanente" class="form-control">
                          <option value="0">Temporária</option>
                          <option value="1">Permanente</option>
                      </select>
                    </div>
                  </div>
                  <!--
                   <div class="col-lg-4">
                    <div class="form-group">
                      <label>Situação</label>
                      <select id="aberta" name="aberta" class="form-control">
                          <option value="1">Aberta</option>
                          <option value="0">Fechada</option>
                      </select>
                    </div>
                  </div>
                      
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Data de Retirada</label>
                            <input type="date" class="form-control" id="dataRetirada" name="dataRetirada" required>
                          </div>
                        </div>
                        
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Vencimento</label>
                            <input type="date" class="form-control" id="vencimento" name="vencimento" required>
                          </div>
                        </div>

                         <div class="col-lg-4">
                          <div class="form-group">
                            <label>Data de Entrega</label>
                            <input type="date" class="form-control" id="dataEntrega" name="dataEntrega" required>
                          </div>
                        </div>
                    
                     <div class="col-lg-4">
                         <div class="form-group">
                            <label>Despachante</label>
                            <select id="idDespachante" id="idDespachante" name="idDespachante" class="form-control" required>
                            <?php
                              //$opt = new PolicialController();
                              //$opt->listaOptions();
                            ?>
                            </select>
                        </div>
                      </div> 

                      <div class="col-lg-4">
                         <div class="form-group">
                            <label>Recebedor</label>
                            <select id="idRecebedor" id="idRecebedor"name="idRecebedor" class="form-control" required>
                            <?php
                             // $opt = new PolicialController();
                             // $opt->listaOptions();
                            ?>
                            </select>
                        </div>
                      </div>  -->

                      </div>
                      <!-- Tabela de acrodo com os docs do projeto -->
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <button type="submit" name="cadastrar" class="btn btn-success">Cadastrar</button>
                        <input type="reset" class="btn btn-danger" id="voltar" name="voltar" value="Cancelar" onClick="history.go(-1)">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <br>
        
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php
        include 'includes/footer.html';
        ?>

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

    <?php
    include 'includes/modalabout.html'
    ?>

    <?php
    include 'includes/script.html';
    ?>

  </body>

</html>
