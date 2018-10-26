<?php
session_start();

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';
include 'properties/properties.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//From settings
$assunto = $assunto;
$nome = $nome;

$email = $_POST["email"];

//codigo de verificação (exemplo)
$codp1 = rand(1000, 9999);
$codp2 = rand(10, 99);

$mensagem = "Código de recuperação: " . $codp1 . "-" . $codp2;

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->CharSet = $charset;
    // $mail->SMTPDebug = 2; // mostra a saída do processo na tela
    $mail->isSMTP();
    $mail->Host = $host;
    $mail->SMTPAuth = true;
    $mail->Username = $username; // seu email (no caso, google)
    $mail->Password = $password; // sua senha do email
    $mail->SMTPSecure = $smtpsecure;
    $mail->Port = $port;

    //From:
    //$mail->SetFrom($mail->Username, 'Bruno Silva');
    $mail->SetFrom($mail->Username, $assunto);
    
    //To:
    $mail->AddAddress($email, $nome);

    $mail->Subject = "Recuperação de senha!";
    $mail->msgHTML("<html><br/>{$nome}<br/>Enviamos um email de recuperação para: {$email}<br/> <!-- Mensagem: --> {$mensagem}</html>");
    $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

    if ($mail->send()) {
        $_SESSION["success"] = "Mensagem enviada com sucesso";
        // header("Location: deucerto.php");
        echo 'Mensagem enviada com sucesso!';
        header('Location: login.php');

    } else {
        $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
        // header("Location: deuerrado.php");
        echo 'Mensagem não foi enviada!';
        header('Location: login.php');
    }
    
} catch (Exception $e) {
    echo 'Mensagem não foi enviada!';
    echo 'Erro: ' . $mail->ErrorInfo;
}
die();
