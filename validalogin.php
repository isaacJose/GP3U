<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

include 'DAO/Conexao.php';

$_SESSION["sessiontime"] = time() + 3600;

$conn = new conexao();
$conexao = $conn->conecta();

$email = $_POST["email"];
$senha = $_POST["senha"];

$query = "SELECT matricula, nome_funcional, tipo FROM operador WHERE email = '$email' AND senha = '$senha' ";

$sql = mysqli_query($conexao, $query) or die(mysqli_error());
$row = mysqli_num_rows($sql);
$result = mysqli_fetch_assoc($sql);

if ($row > 0) {
    session_start();

    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");
    $hra = date("H");
    $min = date("i");
    $seg = date("s");

    $_SESSION['matricula'] = $result['matricula'];
    $matricula = $_SESSION['matricula'];

    $_SESSION['nome_funcional'] = $result['nome_funcional'];
    $nomeFacesso = $_SESSION['nome_funcional'];

    $_SESSION['tipo'] = $result['tipo'];
    $tipo = $_SESSION['tipo'];

    $horaAcesso = "$hra:$min:$seg";
    $dataAcesso = "$dia/$mes/$ano";

    $logquery = "INSERT INTO logacesso (matricula, nomedoacesso, horalogin, datalogin) VALUES ('$matricula', '$nomeFacesso', '$horaAcesso', '$dataAcesso')";

    mysqli_query($conexao, $logquery) or die(mysqli_error($conexao));

    $salvaidacesso = "SELECT id FROM logacesso WHERE horalogin = '$horaAcesso'";
    $sql2 = mysqli_query($conexao, $salvaidacesso) or die(mysqli_error($conexao));
    $row2 = mysqli_num_rows($sql2);
    $result2 = mysqli_fetch_assoc($sql2);

    $_SESSION['iddoacesso'] = $result2['id'];

    header('Location: view/PrincipalView.php');
} else {
    header('Location: forgot-password.php');
}
?>
