<?php
    include 'DAO/Conexao.php';

    date_default_timezone_set('America/Sao_Paulo');

    // Ignore
    $dia = date("d");
    $mes = date("m");
    $ano = date("Y");

    $hra = date("H");
    $min = date("i");
    $seg = date("s");

    $meses = Array("","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

    $horaAcesso = "$hra:$min:$seg";
    $dataAcesso = "$dia/$mes/$ano";

    // ignore 

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $conn = new conexao();
    $conexao = $conn->conecta();

    $query = "select matricula, nome_funcional from operador where email = '$email' and senha = '$senha' ";
    $sql = mysqli_query($conexao, $query) or die(mysqli_error());
    $row = mysqli_num_rows($sql);
    $result = mysqli_fetch_assoc($sql);

    if ($row > 0) {
        session_start();
        
        $_SESSION['nome_funcional'] = $result['nome_funcional'];
        $nomeacesso = $_SESSION['nome_funcional'];
        
        $_SESSION['matricula'] = $result['matricula'];
        $matricula = $_SESSION['matricula'];

        $logquery = "INSERT INTO logacesso (matricula, nomedoacesso, horalogin, datalogin) VALUES ('$matricula', '$nomeacesso', '$horaAcesso', '$dataAcesso')";
        mysqli_query($conexao, $logquery) or die(mysqli_error($conexao));
        //mysqli_close($conexao);
        //$logrow = mysqli_num_rows($logsql);
        //$logresult = mysqli_fetch_assoc($logsql);

        //echo "logado com sucesso!";
        header('Location: view/PrincipalView.php');
    } else {
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header('Location: forgot-password.php');
    }
?>
