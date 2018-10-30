<?php

if (!isset($_SESSION['nome_funcional'])) {
    header('Location: ../login.php');
}

?>