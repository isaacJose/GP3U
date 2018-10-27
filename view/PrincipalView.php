<?php
session_start();
include 'includes/header.html';
//include 'validalogin.php';
?>
  <style>

    img {
        width:150px;
        height:150px;
        top:50%;
        left:50%;
        margin-left:10px;
    }
    .imagem{
      background-color:white;
      border-radius:100%;
      margin-top:10px;
      margin-left:30px;
      margin-right:30px;
    }
    i{
      position: absolute;
    }

    .spanmenu{
      margin-left:30px;
    }

    .exit{
        width:20px;
        height:20px;
        top:50%;
        left:50%;
        margin-left:10px;
    }

    .container img {
      margin-left: auto;
      margin-right: auto;
      width:450px;
      height:450px;
    }

  </style>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="PrincipalView.php">SIGEP</a>

      <!-- Modelo (alterável) download de documentos (se necessário) -->
      <!-- <a class="fasc-button fasc-size-medium fasc-type-flat fasc-ico-before dashicons-admin-links" style="background-color:#33809e;color:#ffffff;" href="https://www.todoespacoonline.com/w/tuts/2014/10/dompdf.zip">Download DOMPDF (com exemplo)</a> -->

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <a class="navbar-brand mr-1" href="#">Bem vindo(a), <?php echo $_SESSION['nome_funcional']; ?> </a>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="exit">
              <i class="material-icons">menu</i>
              <!-- https://materializecss.com/icons.html -->
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
        <li class="nav-item active">
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
              <a href="../view/PrincipalView.php">Principal</a>
            </li>
            <!--<li class="breadcrumb-item active">Tables</li>-->
          </ol>


        </div>
        <br>

        <!-- /.container-fluid -->

        <div align="center" class="container">
          <img src="../img/logo.png"/>
        </div>

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
          <div class="modal-body">Selecione a opção "Sair" para sair do sistema.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <a class="btn btn-primary" href="../login.php">Sair</a>
          </div>
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
