<?php
session_start();
include '../verificasessaoativa.php';
//include '../validasessao.php';
include_once '../controller/CautelaController.php';
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
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label>Policial</label>
                            <input class="form-control" name="idPolicial" placeholder="Matrícula" required>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label>Armamento</label>
                            <input class="form-control" name="Id" placeholder="Serial do armamento" required>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label>Quantidade</label>
                            <input class="form-control" placeholder="Ex.: 10" required>
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group" align="center">
                            <label>Tipo de cautela</label>
                            <div class="radio">
                              <label class="radio-inline">
                                <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="option1" checked>Temporária
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="option2">Permanente
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label>Vencimento</label>
                            <input class="form-control" name="vencimento" required>
                          </div>
                        </div>
                      </div>
                      <!-- Tabela de acrodo com os docs do projeto -->
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <button type="submit" name="cadastrar" class="btn btn-success">Cadastrar</button>
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

    <?php
    include 'includes/script.html';
    ?>

  </body>

</html>
