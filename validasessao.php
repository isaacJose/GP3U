<?php
//session_start();
include 'DAO/Conexao.php';
date_default_timezone_set('America/Sao_Paulo');

$conn = new conexao();
$conexao = $conn->conecta();

if (isset($_SESSION["sessiontime"])) {
    if ($_SESSION["sessiontime"] < time()) {

        $dia = date("d");
        $mes = date("m");
        $ano = date("Y");

        $hra = date("H");
        $min = date("i");
        $seg = date("s");

        $horaSaida = "$hra:$min:$seg";
        $dataSaida = "$dia/$mes/$ano";

        $idlogoff = $_SESSION['iddoacesso'];

        $inseresaida = "UPDATE logacesso SET horalogout = '$horaSaida', datalogout = '$dataSaida' WHERE id = '$idlogoff'";

        mysqli_query($conexao, $inseresaida) or die(mysqli_error($conexao));

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