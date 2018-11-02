<?php
if (isset($_SESSION)) {
  session_unset();
  session_destroy();
}

include 'view\includes\headerpass.html';
?>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <!-- <div class="card-header">Login</div> -->
        <div style="font-family: 'Roboto Slab', serif;">
          <center>
            <img src="img/sigeplogologin.jpg" height="345" width="300">
          </center>
        </div>
        <div class="card-body">
          <!-- <form action="controller/LoginController.php" method="post"> -->
          <form name="loginform" action="validalogin.php" method="post">
          <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email address" autofocus="autofocus" value="" required>
                <label for="email">Endereço de email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="password" name="senha" class="form-control" placeholder="Password" value="" required>
                <label for="password">Senha</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Lembrar senha
                </label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" id="Entrar" name="Entrar" value="Entrar">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Registrar conta</a>
            <a class="d-block small" href="forgot-password.php">Esqueceu a senha?</a>
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
