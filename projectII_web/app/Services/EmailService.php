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
            
            $activationLink = "http://proyecto02.com/activate?email=" . urlencode($usuario->correo) . "&token=" . urlencode($usuario->token);
            $mail->Body = $this->getActivationEmailTemplate($usuario->nombre, $activationLink);

            return $mail->send();
            
        } catch (Exception $e) {
            error_log("Error enviando correo: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Enviar correo de login sin contraseña
     */
    public function sendPasswordlessLoginEmail($usuario, $token): bool
    {
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aventomescr@gmail.com';
            $mail->Password = 'ubon jmov ryip sxmk';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('aventomescr@gmail.com', 'AventonesCR');
            $mail->addAddress($usuario->correo, $usuario->nombre);

            $mail->isHTML(true);
            $mail->Subject = 'Acceso sin contraseña - AventonesCR';
            
            $loginLink = "http://proyecto02.com/index.php/passwordless-login/" . $token;
            error_log("PASSWORDLESS DEBUG: URL generada para email: " . $loginLink);
            $mail->Body = $this->getPasswordlessLoginEmailTemplate($usuario->nombre, $loginLink);

            return $mail->send();
            
        } catch (Exception $e) {
            error_log("Error enviando correo passwordless: " . $e->getMessage());
            return false;
        }
    }

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

    private function getPasswordlessLoginEmailTemplate(string $nombre, string $loginLink): string
    {
        return "
            <h2>¡Hola {$nombre}!</h2>
            <p>Has solicitado acceder a tu cuenta sin contraseña.</p>
            <p><strong>Haz clic en el siguiente botón para ingresar a tu cuenta:</strong></p>
            <div style='text-align: center; margin: 20px 0;'>
                <a href='{$loginLink}' style='background-color: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-size: 16px; display: inline-block;'>
                    🔐 Ingresar a mi cuenta
                </a>
            </div>
            <p><strong>Importante:</strong></p>
            <ul>
                <li>Este link es válido por 15 minutos</li>
                <li>Solo se puede usar una vez</li>
            </ul>
            <br>
            <p><strong>Equipo AventonesCR</strong></p>
        ";
    }
}