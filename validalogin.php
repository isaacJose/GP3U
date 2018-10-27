<?php
$banco = "sigep";
$host = "localhost";
$userbd = "root";
$senhabd = "";

$conexao = mysqli_connect($host, $userbd, $senhabd) or die(mysqli_error());
$conexaobd = mysqli_select_db($conexao, $banco) or die(mysqli_error());
?>

<?php
$email = $_POST["email"];

$sql = mysqli_query($conexao, "select nome_funcional from policial where email = '$email' ") or die(mysqli_error());
$row = mysqli_num_rows($sql);

$result = mysqli_fetch_assoc($sql);

if ($row > 0) {
    session_start();
    //$_SESSION['email'] = $_POST['email'];
    $_SESSION['nome_funcional'] = $result['nome_funcional'];
    echo "logado com sucesso!";
    header('Location: view/PrincipalView.php');
}

//brunno.linkin@gmail.com
?>
