<?php
session_start();

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

//From settings
$empresa = "Atendimento SIGEP";
$nome = "Olá usuário(a).";
$email = $_POST["email"];
$mensagem = "Código de recuperação: S3DRE-59";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->CharSet = 'UTF-8';
    // $mail->SMTPDebug = 2; // mostra a saída do processo na tela
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'email@gmail.com'; // seu email (no caso, google)
    $mail->Password = 'password'; // sua senha do email
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //From:
    //$mail->SetFrom($mail->Username, 'Bruno Silva');
    $mail->SetFrom($mail->Username, $empresa);
    
    //To:
    $mail->AddAddress($email, $nome);

    $mail->Subject = "Recuperação de senha!";
    $mail->msgHTML("<html><br/>{$nome}<br/>Enviamos um email de recuperação para: {$email}<br/> <!-- Mensagem: --> {$mensagem}</html>");
    $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

    if ($mail->send()) {
        $_SESSION["success"] = "Mensagem enviada com sucesso";
        // header("Location: deucerto.php");
        echo 'Mensagem enviada com sucesso!';
        header('Location: view/PrincipalView.php');

    } else {
        $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
        // header("Location: deuerrado.php");
        echo 'Mensagem não foi enviada!';
    }
    
} catch (Exception $e) {
    echo 'Mensagem não foi enviada!';
    echo 'Erro: ' . $mail->ErrorInfo;
}
die();
