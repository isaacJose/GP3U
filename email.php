<?php
session_start();

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

include 'properties/properties.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//From settings
$assunto = $p_assunto;
$nome = $p_nome;

$email = $_POST["email"];

//codigo de verificação (exemplo)
$codp1 = rand(1000, 9999);
$codp2 = rand(10, 99);

$mensagem = "Código de recuperação: " . $codp1 . "-" . $codp2;

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->CharSet = $p_charset;
    // $mail->SMTPDebug = 2; // mostra a saída do processo na tela
    $mail->isSMTP();
    $mail->Host = $p_host;
    $mail->SMTPAuth = true;
    $mail->Username = $p_username; // seu email (no caso, google)
    $mail->Password = $p_password; // sua senha do email
    $mail->SMTPSecure = $p_smtpsecure;
    $mail->Port = $p_port;

    //From:
    $mail->SetFrom($mail->Username, $assunto);
    
    //To:
    $mail->AddAddress($email, $nome);

    $mail->Subject = "Recuperação de senha!";
    $mail->msgHTML("<html><br/>{$nome}<br/>Enviamos um email de recuperação para: {$email}<br/> <!-- Mensagem: --> {$mensagem}</html>");
    $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

    if ($mail->send()) {
        $_SESSION["success"] = "Mensagem enviada com sucesso";
        echo 'Mensagem enviada com sucesso!';
        header('Location: login.php');

    } else {
        $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
        echo 'Mensagem não foi enviada!';
        header('Location: login.php');
    }
    
} catch (Exception $e) {
    echo 'Mensagem não foi enviada!';
    echo 'Erro: ' . $mail->ErrorInfo;
}
die();
