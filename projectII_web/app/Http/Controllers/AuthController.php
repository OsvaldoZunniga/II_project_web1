<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Mostrar la página de login
     */
    public function showLogin(Request $request)
    {
        // Solo redirigir si viene del home "/" sin parámetros especiales
        // Permitir volver al login con botón atrás o logout
        $allowReturn = $request->has('return') || $request->has('msg') || session('msg');
        
        if ($this->authService->isAuthenticated() && !$allowReturn) {
            return redirect($this->authService->getDashboardRoute());
        }

        $message = $request->get('msg') ?? session('msg');
        
        return view('auth.login', compact('message'));
    }

    /**
     * Procesar el login
     * Solo coordina, delega la lógica al servicio
     */
    public function login(Request $request)
    {
        try {
            // Validar datos básicos
            $request->validate([
                'correo' => 'required|email',
                'contrasena' => 'required'
            ]);

            // Delegar al servicio
            $result = $this->authService->attemptLogin(
                trim($request->correo),
                trim($request->contrasena)
            );

            if ($result['success']) {
                // Login exitoso - redirigir al dashboard
                return redirect($this->authService->getDashboardRoute());
            } else {
                // Login fallido - volver al login con mensaje
                return redirect()->route('login')->with('msg', $result['message']);
            }

        } catch (\Exception $e) {
            // Log del error
            error_log("Error en login: " . $e->getMessage());
            return redirect()->route('login')->with('msg', 'error_general');
        }
    }

    /**
     * Cerrar sesión
     * Solo coordina, delega la lógica al servicio
     */
    public function logout(Request $request)
    {
        $this->authService->logout();
        
        return redirect()->route('login')->with('msg', 'logout_success');
    }
}