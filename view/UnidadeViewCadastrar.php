<?php
    include_once '../controller/UnidadeController.php';
    include 'includes/header.html';
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

    .btn-circle {
      width: 30px;
      height: 30px;
      padding: 6px 0;
      border-radius: 15px;
      text-align: center;
      font-size: 12px;
      line-height: 1.428571429;
    }

    .btn-xs{padding:1px 5px;font-size:12px;line-height:1.5;border-radius:3px}


</style>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">SIGEP</a>

      

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
              <i class="material-icons" >exit_to_app</i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">            
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
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
        <li class="nav-item active">
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
              <a href="../view/UnidadeView.php">Unidades</a>
            </li>
            <li class="breadcrumb-item active">Cadastrar</li>
            <!--<li class="breadcrumb-item active">Tables</li>-->
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="material-icons">grid_on</i>
              <span class="spanmenu">Unidade- Formulário de cadastro</span>
            </div>
            <div class="card-body">
              <form action="../controller/UnidadeController.php" method="post">
                <div class="row">
                  <div class="col-lg-6"> 
                    <div class="form-group">
                      <label>Unidade</label>
                      <input id="unidade" type="text" name="descricao" class="form-control" placeholder="Ex.: 6º Batalhão de Policia Militar" title="Campo referente a unidade">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Sigla</label>
                      <input id="sigla" type="text" name="sigla" class="form-control" placeholder="Ex.: 6BPM" title="Campo referente a sigla">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <input type="submit" class="btn btn-success" id="cadastrar" name="cadastrar" value="Cadastrar"> 
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
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
      include 'includes/script.html';
    ?>

  </body>

</html>
