<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

include 'DAO/Conexao.php';

$conn = new conexao();
$conexao = $conn->conecta();

$dia = date("d");
$mes = date("m");
$ano = date("Y");

$hra = date("H");
$min = date("i");
$seg = date("s");

$horaSaida = "$hra:$min:$seg";
$dataSaida = "$dia/$mes/$ano";

$matricula = $_SESSION['matricula'];

$inseresaida = "UPDATE logacesso SET horalogout = '$horaSaida', datalogout = '$dataSaida' WHERE matricula = '$matricula'";

mysqli_query($conexao, $inseresaida) or die(mysqli_error($conexao));

echo "att";

header ("Location: www.google.com");

//atualizasessao.php