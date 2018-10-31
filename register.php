<?php
    include 'view\includes\headerpass.html';
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
          <form>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="firstName" class="form-control" placeholder="Nome funcional" required="required" autofocus="autofocus">
                    <label for="firstName">Nome funcional</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="lastName" class="form-control" placeholder="Matrícula" required="required">
                    <label for="lastName">Matrícula</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="E-mail" required="required">
                <label for="inputEmail">E-mail</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required="required">
                    <label for="inputPassword">Senha</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirmar Senha" required="required">
                    <label for="confirmPassword">Confirmar senha</label>
                  </div>
                </div>
              </div>
            </div>
            <a class="btn btn-primary btn-block" href="#">Registrar</a>
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

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
