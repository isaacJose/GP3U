<?php
    include 'view\includes\headerpass.html';
?>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
      <div aling="center">
            <center>
                <img src="img/sigeplogoreset.jpg" height="345" width="300">
            </center>
          </div>
        <!-- <div class="card-header">Reset Password</div> -->
        <div class="card-body">
          <div class="text-center mb-4">
            <h4>Esqueceu a sua senha?</h4>
            <p>Digite o seu email e enviaremos para você instruções de como recuperar a sua sennha.</p>
          </div>
          <form action="email.php" name="sendemail" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Enter email address" required="required" autofocus="autofocus" name="email">
                <label id="email" for="inputEmail">Digite seu endereço de email</label>
              </div>
            </div>
            <!-- <a class="btn btn-primary btn-block" href="login.php">Resetar senha</a> -->
            <input type="submit" class="btn btn-primary btn-block" id="cadastrar" name="cadastrar" value="Recuperar senha
            "> 
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Registrar uma conta</a>
            <a class="d-block small" href="login.php">Página de login</a>
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
