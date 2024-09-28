<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['contact-message']);

    $mail = new PHPMailer(true); // Crear una instancia de PHPMailer
    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'colmanbautista93@gmail.com'; // Cambia esto a tu dirección de correo
        $mail->Password = 'irby qkga bgir ahqs'; // Usa la contraseña de aplicación
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Destinatarios
        $mail->setFrom($email, $name); // Correo del remitente
        $mail->addAddress('colmanbautista93@gmail.com'); // Tu dirección de correo

        // Contenido del correo
        $mail->isHTML(false);
        $mail->Subject = 'Nuevo mensaje del formulario';
        $mail->Body = "Nombre: $name\nCorreo: $email\nTeléfono: $phone\nMensaje:\n$message";

        // Enviar el correo
        $mail->send();
        echo "El mensaje se envió correctamente.";
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
