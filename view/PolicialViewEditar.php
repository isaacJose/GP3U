<?php
    include_once '../controller/PolicialController.php';

    include_once '../DAO/SubunidadeDao.php';
    //include_once '../model/Subunidade.php';
    include_once '../DAO/Conexao.php';

    include 'includes/header.html';
?>

  

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">SIGEP</a>

      <?php
        include 'includes/style/PolicialViewCadastrar.html';
      ?>

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
        <li class="nav-item active">
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
              <a href="../view/PolicialView.php">Policiais</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
            <!--<li class="breadcrumb-item active">Tables</li>-->
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="material-icons">grid_on</i>
              <span class="spanmenu">Policiais - Formulário de edição</span>
            </div>
            <div class="card-body">

            <!-- Form -->
              <form action="../controller/PolicialController.php" method="post">
                <div class="row">
                  <div class="col-lg-5">                                        
                    <div class="form-group">
                      <label>Nome</label>
                      <?php
                      $id = filter_input(INPUT_POST,"id",FILTER_SANITIZE_STRING);
                      $conexao = new conexao();
                      $nome = PolicialDao::recuperaNome($conexao, $id);
                      echo "<input name='nome' value='$nome' class='form-control' placeholder='Nome completo do policial' required>"
                      ?>
                    </div>                                        
                  </div>
                  <div class="col-lg-2">                                        
                    <div class="form-group">
                      <label>Patente</label>
                      <select name="patente" class="form-control">
                        <?php
                        $graduacao = PolicialDao::recuperaPatente($conexao, $id);
                        echo"<option selected>".$graduacao."</option>";
                        //$opt = new SubunidadeController();
                        //$opt->listaOptions();
                        ?>
                        <option>Soldado</option>
                        <option>Cabo</option>
                        <option>Sargento</option>
                        <option>Sargento</option>
                        <option>Sargento</option>
                        <option>Subtenente</option>
                        <option>Aspirante</option>
                        <option>Segundo-tenente</option>
                        <option>Primeiro-tenente</option>
                        <option>Capitão</option>
                        <option>Major</option>
                        <option>Tenente-coronel</option>
                        <option>Coronel</option>
                      </select>
                    </div>                                        
                  </div>
                  <div class="col-lg-3">                                        
                    <div class="form-group">
                      <label>Nome Funcional</label>
                      <?php
                      $nome_funcional = PolicialDao::recuperaNomeFuncional($conexao, $id);
                      echo "<input name='nome_funcional' value='$nome_funcional' class='form-control' required>";
                      ?>
                    </div>                                        
                  </div>
                  <div class="col-lg-2">                                        
                    <div class="form-group">
                      <label>Matrícula</label>
                      <?php
                      $matricula = PolicialDao::recuperaMatricula($conexao, $id);
                      echo "<input name='matricula' value='$matricula' class='form-control' placeholder='Ex.: 123456-0' required>";
                      ?>
                    </div>                                        
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">                                        
                    <div class="form-group">
                      <label>E-mail</label>
                      <?php
                      $email = PolicialDao::recuperaEmail($conexao, $id);
                      echo "<input name='email' class='form-control' value='$email' placeholder='Ex.: email@exemplo.com' required>";
                      ?>
                    </div>                                        
                  </div>
                  <div class="col-lg-4" >                                        
                    <div class="form-group" align="center">
                      <label>Situação</label>
                      <div class="radio">
                        <label class="radio-inline">
                          <?php
                          $situacao = PolicialDao::recuperaSituacao($conexao, $id);
                          ?>
                          <input type="radio" name="situacao" id="optionsRadiosInline1" value="Apto" <?php if($situacao == "Apto") echo "checked";?>>Operacional
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="situacao" id="optionsRadiosInline2" value="Junta psiquiátrica" <?php if($situacao == "Junta psiquiátrica") echo "checked";?>>Junta psiquiátrica
                        </label>
                      </div>
                    </div>                                        
                  </div>
                  <div class="col-lg-4">                                        
                    <div class="form-group">
                      <label>Lotação</label>
                      <select name="subunidade" class="form-control">
                        <?php
                        $subunidadeId = PolicialDao::recuperaIdSubunidade($conexao, $id);
                        $subunidade = PolicialDao::recuperaSiglaSubunidade($conexao, $subunidadeId);
                        echo"<option selected>".$subunidade."</option>";
                        $opt = new PolicialController();
                        $opt->listaOptions();
                        echo '<input type="hidden" name="id" value="'.$id.'">';  
                        ?>    
                      </select>
                    </div>                                        
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <input type="submit" name="editar" value="Editar" class="btn btn-primary">
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
      include 'includes/script.html';
    ?>

  </body>

</html>
