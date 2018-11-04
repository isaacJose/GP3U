<?php

include 'DAO/Conexao.php';

$conn = new conexao();
$conexao = $conn->conecta();

echo $nomecompleto = $_POST["nome"];
echo $nomefuncional = $_POST["nome_funcional"];
echo $matricula = $_POST["matricula"];
echo $email = $_POST["email"];
echo $senha = $_POST["senha"];

$insere = true;

if ($insere) {

    $query = "INSERT INTO operador (nome, nome_funcional, matricula, email, senha) VALUES ('$nomecompleto', '$nomefuncional', '$matricula', '$email', '$senha')";

    mysqli_query($conexao, $query) or die(mysqli_error($conexao));

    session_destroy();
    header('Location: Login.php');
} else {
    session_destroy();
    header('Location: forgot-password.php');
}
?>
