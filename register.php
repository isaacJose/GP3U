<?php
if (isset($_SESSION)) {
  session_unset();
  session_destroy();
}
include 'view\includes\headerpass.html';
include 'view\includes\header.html';
?>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
      <div aling="center">
            <center>
              <img src="img/sigeplogocadastro.jpg" height="345" width="300">
            </center>
          </div>
        <!-- <div class="card-header">Register an Account</div> -->
        <div class="card-body">
          <form action="validaregistro.php" name="formuser" method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome Completo" required="required" autofocus="autofocus">
                    <label for="nome">Nome Completo</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="nome_funcional" name="nome_funcional" class="form-control" placeholder="Nome Funcional" required="required">
                    <label for="nome_funcional">Nome Funcional</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" id="matricula" name="matricula" class="form-control" placeholder="Matrícula" required="required" autofocus="autofocus">
                    <label for="matricula">Matrícula</label>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-label-group">
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="required">
                    <label for="email">Email</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="senha" required="required">
                    <label for="senha">Senha</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="csenha" class="form-control" placeholder="Confirmar Senha" required="required">
                    <label for="csenha">Confirmar senha</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- <a class="btn btn-primary btn-block" href="#">Registrar</a> -->
            <input type="submit" class="btn btn-primary btn-block" id="Registrar" name="Registrar" onClick="return validar()" value="Registrar">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="login.php">Página de login</a>
            <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/bootstrap/js/jquery.mask.min.js"></script>
    <script src="vendor/bootstrap/js/main.js"></script>    

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
