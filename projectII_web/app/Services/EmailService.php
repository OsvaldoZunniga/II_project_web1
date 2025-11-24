<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    /**
     * Enviar correo de activación
     */
    public function sendActivationEmail($usuario): bool
    {
        $mail = new PHPMailer(true);
        
        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aventomescr@gmail.com';
            $mail->Password = 'ubon jmov ryip sxmk';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Destinatario y remitente
            $mail->setFrom('aventomescr@gmail.com', 'AventonesCR');
            $mail->addAddress($usuario->correo, $usuario->nombre);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Activar cuenta';
            
            $activationLink = "http://proyecto02.com/activate?email={$usuario->correo}&token={$usuario->token}";
            $mail->Body = $this->getActivationEmailTemplate($usuario->nombre, $activationLink);

            return $mail->send();
            
        } catch (Exception $e) {
            // Log del error (opcional)
            error_log("Error enviando correo: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Plantilla del correo de activación
     */
    private function getActivationEmailTemplate(string $nombre, string $activationLink): string
    {
        return "
            <h2>¡Hola {$nombre}!</h2>
            <p>Gracias por registrarte en AventonesCR.</p>
            <p>Para activar tu cuenta, haz clic en el siguiente enlace:</p>
            <p><a href='{$activationLink}' style='background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Activar cuenta</a></p>
            <br>
            <p>¡Gracias!</p>
            <p><strong>Equipo AventonesCR</strong></p>
        ";
    }
}