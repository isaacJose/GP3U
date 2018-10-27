<?php
include 'DAO/Conexao.php';

$email = $_POST["email"];
$senha = $_POST["senha"];

$conn = new conexao();
$conexao = $conn->conecta();

$query = "select nome_funcional from operador where email = '$email' and senha = '$senha' ";
$sql = mysqli_query($conexao, $query) or die(mysqli_error());
$row = mysqli_num_rows($sql);

$result = mysqli_fetch_assoc($sql);

if ($row > 0) {
    session_start();
    //$_SESSION['email'] = $_POST['email'];
    $_SESSION['nome_funcional'] = $result['nome_funcional'];
    echo "logado com sucesso!";
    header('Location: view/PrincipalView.php');
} else {
    $_SESSION['loginErro'] = "Usuário ou senha inválido";
    header('Location: login.php');
}

//bruno.linkin@gmail.com
?>
