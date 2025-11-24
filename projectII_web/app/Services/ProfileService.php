<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileService
{
    /**
     * Obtener datos del perfil del usuario
     */
    public function getUserProfile($idUsuario): ?array
    {
        $user = User::select([
            'nombre', 
            'apellido', 
            'nacimiento', 
            'correo', 
            'telefono',
            'fotografia'
        ])
        ->where('idUsuario', $idUsuario)
        ->first();

        return $user ? $user->toArray() : null;
    }

    /**
     * Actualizar perfil del usuario
     */
    public function updateProfile($idUsuario, array $data, $foto = null): array
    {
        try {
            // Validar que las contraseñas coincidan
            if ($data['contrasena'] !== $data['contrasena_confirm']) {
                return ['success' => false, 'message' => 'password_mismatch'];
            }

            // Obtener datos actuales del usuario
            $currentUser = User::find($idUsuario);
            if (!$currentUser) {
                return ['success' => false, 'message' => 'user_not_found'];
            }

            // Procesar nueva foto si existe
            $fotoPath = $currentUser->fotografia; // Mantener foto actual por defecto
            if ($foto && $foto->isValid()) {
                // Eliminar foto anterior si existe
                if (!empty($currentUser->fotografia) && file_exists(public_path($currentUser->fotografia))) {
                    unlink(public_path($currentUser->fotografia));
                }
                $fotoPath = $this->uploadProfilePhoto($foto);
            }

            // Hash de la nueva contraseña
            $hashedPassword = Hash::make($data['contrasena']);

            // Actualizar usuario
            $updated = User::where('idUsuario', $idUsuario)
                ->update([
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'nacimiento' => $data['nacimiento'],
                    'correo' => $data['correo'],
                    'telefono' => $data['telefono'],
                    'fotografia' => $fotoPath,
                    'contrasena' => $hashedPassword
                ]);

            // Datos para actualizar la sesión
            $sessionUpdate = [
                'nombre' => $data['nombre'],
                'correo' => $data['correo'],
                'fotografia' => $fotoPath
            ];

            return [
                'success' => true, 
                'updateSession' => $sessionUpdate
            ];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'update_error'];
        }
    }

    /**
     * Subir foto de perfil
     */
    private function uploadProfilePhoto($foto): string
    {
        $carpeta = 'assets/';
        
        // Crear directorio si no existe
        if (!file_exists(public_path($carpeta))) {
            mkdir(public_path($carpeta), 0755, true);
        }

        $nuevoNombre = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path($carpeta), $nuevoNombre);

        return $carpeta . $nuevoNombre;
    }
}