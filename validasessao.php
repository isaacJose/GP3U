<?php
//session_start();
if (isset($_SESSION["sessiontime"])) {
    if ($_SESSION["sessiontime"] < time()) {
        session_unset();
        //echo "Seu tempo Expirou!";
        //Redireciona para login
        session_destroy();
        header("Location: ../login.php");
    } else {
        //echo 'Logado ainda!';
        //Seta mais tempo 60 segundos
        $_SESSION["sessiontime"] = time() + 30;
    }
}