<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordlessService
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Enviar link de login sin contraseña
     */
    public function sendLoginLink($email): array
    {
        // Buscar usuario por email
        $user = User::where('correo', $email)->first();

        if (!$user) {
            return [
                'success' => false,
                'error' => 'user_not_found'
            ];
        }

        // Verificar que la cuenta esté activa
        if ($user->estado === 'Pendiente') {
            return [
                'success' => false,
                'error' => 'pending'
            ];
        }
        
        if ($user->estado === 'Inactivo') {
            return [
                'success' => false,
                'error' => 'inactive'
            ];
        }
        $token = Str::random(60) . '_' . time();

        // Guardar token en la base de datos
        $user->login_token = $token;
        $user->save();

        // Enviar correo
        $emailSent = $this->emailService->sendPasswordlessLoginEmail($user, $token);

        if ($emailSent) {
            return [
                'success' => true,
                'message' => 'Link enviado correctamente'
            ];
        } else {
            return [
                'success' => false,
                'error' => 'email_error'
            ];
        }
    }

    /**
     * Login usando token del correo
     */
    public function loginWithToken($token): array
    {
        // Buscar usuario por token
        $user = User::where('login_token', $token)->first();

        if (!$user) {
            return [
                'success' => false,
                'error' => 'invalid_token'
            ];
        }

        // Verificar que el token no pase el tiempo (15 minutos)
        $tokenParts = explode('_', $token);
        if (count($tokenParts) >= 2) {
            $tokenTime = intval(end($tokenParts));
            $currentTime = time();
            $minutesElapsed = ($currentTime - $tokenTime) / 60;

            if ($minutesElapsed > 15) {
                // Token expirado, limpiarlo
                $user->login_token = null;
                $user->save();

                return [
                    'success' => false,
                    'error' => 'token_expired'
                ];
            }
        }

        // Verificar que la cuenta esté activa
        if ($user->estado === 'Pendiente') {
            return [
                'success' => false,
                'error' => 'pending'
            ];
        }
        
        if ($user->estado === 'Inactivo') {
            return [
                'success' => false,
                'error' => 'inactive'
            ];
        }

        // Token válido - limpiar el token (uso único) y retornar usuario
        $user->login_token = null;
        $user->save();

        return [
            'success' => true,
            'user' => $user
        ];
    }
}