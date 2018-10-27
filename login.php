<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIGEP</title>

    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="16x16" href="img/sigeplogo2.png">

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

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
                <input type="password" id="password" name="senha" class="form-control" placeholder="Password" required>
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
