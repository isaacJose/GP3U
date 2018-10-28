<?php
    session_start();

    include 'DAO/Conexao.php';

    date_default_timezone_set('America/Sao_Paulo');

    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");

    $hra = date("H");
    $min = date("i");
    $seg = date("s");

    $meses = Array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

    $horaSaida = "$hra:$min:$seg";
    $dataSaida = "$dia/$mes/$ano";

    $nomeacesso = $_SESSION['nome_funcional'];
    $matricula = $_SESSION['matricula'];

    $conn = new conexao();
    $conexao = $conn->conecta();

    $query = "UPDATE logacesso SET horalogout = '$horaSaida', datalogout = '$dataSaida' WHERE nomedoacesso = '$nomeacesso' AND matricula = '$matricula' ";

    mysqli_query($conexao, $query) or die(mysqli_error($conexao));

    session_destroy();

    header("Location: login.php");
?>