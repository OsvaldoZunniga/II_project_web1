<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthService
{
    /**
     * Intentar autenticar usuario
     */
    public function attemptLogin(string $correo, string $contrasena): array
    {
        // 1. Buscar usuario por correo
        $user = User::where('correo', $correo)->first();

        if (!$user) {
            return ['success' => false, 'message' => 'user_not_found'];
        }

        // 2. Verificar estado de la cuenta
        if ($user->estado === 'Pendiente') {
            return ['success' => false, 'message' => 'pending'];
        }

        if ($user->estado === 'Inactivo') {
            return ['success' => false, 'message' => 'inactive'];
        }

        // 3. Verificar contraseña
        if (!Hash::check($contrasena, $user->contrasena)) {
            return ['success' => false, 'message' => 'wrong_pass'];
        }

        // 4. Iniciar sesión
        $this->startUserSession($user);

        return ['success' => true, 'user' => $user];
    }

    /**
     * Iniciar sesión del usuario
     */
    private function startUserSession(User $user): void
    {
        Session::put([
            'idUsuario' => $user->idUsuario,
            'nombre' => $user->nombre,
            'correo' => $user->correo,
            'fotografia' => $user->fotografia,
            'idRoles' => $user->idRoles,
            'authenticated' => true
        ]);
    }

    /**
     * Cerrar sesión
     */
    public function logout(): void
    {
        Session::flush();
        Session::regenerate();
    }

    /**
     * Verificar si el usuario está autenticado
     */
    public function isAuthenticated(): bool
    {
        return Session::get('authenticated', false);
    }

    /**
     * Obtener usuario autenticado
     */
    public function getAuthenticatedUser(): ?array
    {
        if (!$this->isAuthenticated()) {
            return null;
        }

        return [
            'idUsuario' => Session::get('idUsuario'),
            'nombre' => Session::get('nombre'),
            'correo' => Session::get('correo'),
            'fotografia' => Session::get('fotografia'),
            'idRoles' => Session::get('idRoles')
        ];
    }

    /**
     * Verificar rol del usuario
     */
    public function hasRole(int $roleId): bool
    {
        return Session::get('idRoles') == $roleId;
    }

    /**
     * Obtener URL de redirección según rol
     */
    public function getDashboardRoute(): string
    {
        return route('dashboard');
    }

    /**
     * Actualizar datos de la sesión
     */
    public function updateSessionData(array $data): void
    {
        foreach ($data as $key => $value) {
            Session::put($key, $value);
        }
    }
}