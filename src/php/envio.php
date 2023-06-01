<?php

require_once 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';

$mail = new PHPMailer();


$mail->CharSet = 'UTF-8';
$mail->SMTPDebug = 0; 
$mail->isHTML(true); 


$mail->isSMTP();
$mail->Host = 'smtp.office365.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'oslectecnologia@outlook.com';
$mail->Password = '88caio88';
$mail->setFrom('oslectecnologia@outlook.com', 'oslec tec');
$mail->SMTPSecure = 'tls';


$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'meubancodedados';

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die('Falha na conexão com o banco de dados: ' . $conn->connect_error);
}


$sql = 'SELECT email FROM usuarios LIMIT 500';
$resultado = $conn->query($sql);


$totalRemetentes = 0;

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $email = $row['email'];

    
        $mail->addAddress($email);

    
        $assunto = $_POST['assunto']; 
        $mensagem = $_POST['mensagem'];

        $mail->Subject = $assunto;
        $mail->Body = $mensagem;

        
        if ($_FILES['anexo']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['anexo']['tmp_name'];
            $nome_anexo = $_FILES['anexo']['name'];
            $mail->addAttachment($tmp_name, $nome_anexo);
        }

    
        if (!$mail->send()) {
            echo 'Erro ao enviar e-mail para ' . $email . ': ' . $mail->ErrorInfo;
        } else {
            echo 'E-mail enviado para ' . $email . '<br>';
            $totalRemetentes++;
        }

    
        $mail->clearAddresses();
        $mail->clearAttachments();
    }
} else {
    echo 'Nenhum e-mail encontrado no banco de dados.';
}


echo 'Total de remetentes de e-mail: ' . $totalRemetentes;

// Fecha a conexão com o banco de dados
$conn->close();
?>