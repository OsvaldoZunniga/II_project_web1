<?php

namespace App\Services;

use App\Models\User;
use App\Services\EmailService;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    protected $emailService;
    protected $fileUploadService;

    public function __construct(EmailService $emailService, FileUploadService $fileUploadService)
    {
        $this->emailService = $emailService;
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Registrar un nuevo usuario
     */
    public function registerUser(array $data)
    {
        // 1. Validar contraseñas
        if ($data['contrasena'] !== $data['contrasena_confirm']) {
            return 'pass_mismatch';
        }

        // 2. Verificar si la cédula ya existe
        if ($this->cedulaExists($data['cedula'])) {
            return 'cedula_existe';
        }

        // 3. Verificar si el correo ya existe
        if ($this->emailExists($data['correo'])) {
            return 'correo_existe';
        }

        // 4. Manejar la foto (si existe)
        $fotoRuta = '';
        if (isset($data['fotografia'])) {
            $fotoRuta = $this->fileUploadService->uploadProfileImage($data['fotografia']);
        }

        // 5. Generar token de activación
        $token = bin2hex(random_bytes(16));

        // 6. Crear usuario
        $usuario = User::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'cedula' => $data['cedula'],
            'nacimiento' => $data['nacimiento'],
            'correo' => $data['correo'],
            'telefono' => $data['telefono'],
            'fotografia' => $fotoRuta,
            'contrasena' => Hash::make($data['contrasena']),
            'idRoles' => $data['idRoles'],
            'token' => $token,
            'estado' => 'Pendiente'
        ]);

        // 7. Enviar correo de activación
        $emailSent = $this->emailService->sendActivationEmail($usuario);

        return $emailSent ? 'pending' : 'invalid';
    }

    /**
     * Activar cuenta de usuario
     */
    public function activateUser(string $email, string $token)
    {
        $usuario = User::where('correo', $email)
                      ->where('token', $token)
                      ->where('estado', 'Pendiente')
                      ->first();

        if (!$usuario) {
            return 'invalid';
        }

        $usuario->update([
            'estado' => 'Activo',
            'token' => null
        ]);

        return 'activated';
    }

    /**
     * Verificar si la cédula ya existe
     */
    private function cedulaExists(string $cedula): bool
    {
        return User::where('cedula', $cedula)->exists();
    }

    /**
     * Verificar si el correo ya existe
     */
    private function emailExists(string $correo): bool
    {
        return User::where('correo', $correo)->exists();
    }
}