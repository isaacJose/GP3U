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

    $query = "select id, matricula, nome_funcional from operador where email = '$email' and senha = '$senha' ";
    
    $sql = mysqli_query($conexao, $query) or die(mysqli_error());
    $row = mysqli_num_rows($sql);
    $result = mysqli_fetch_assoc($sql);

    if ($row > 0) {
        session_start();
        
        $_SESSION['idsessao'] = $result['id'];
        $isdessap = $_SESSION['idsessao'];

        $_SESSION['nome_funcional'] = $result['nome_funcional'];
        $nomeacesso = $_SESSION['nome_funcional'];
        
        $_SESSION['matricula'] = $result['matricula'];
        $matricula = $_SESSION['matricula'];

        $logquery = "INSERT INTO logacesso (matricula, nomedoacesso, horalogin, datalogin) VALUES ('$matricula', '$nomeacesso', '$horaAcesso', '$dataAcesso')";
        mysqli_query($conexao, $logquery) or die(mysqli_error($conexao));
        
        //mysqli_close($conexao);
        //$logrow = mysqli_num_rows($logsql);
        //$logresult = mysqli_fetch_assoc($logsql);

        $salvaacesso = "select id from logacesso where horalogin = '$horaAcesso'";
        $sql2 = mysqli_query($conexao, $salvaacesso) or die(mysqli_error($conexao));
        $row2 = mysqli_num_rows($sql2);
        $result2 = mysqli_fetch_assoc($sql2);

        $_SESSION['iddoacesso'] = $result2['id'];
        //echo $_SESSION['iddoacesso'];

        //echo "logado com sucesso!";
        header('Location: view/PrincipalView.php');
    } else {
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header('Location: forgot-password.php');
    }
?>
