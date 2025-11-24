<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class DashboardController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Mostrar el dashboard principal
     * El nav se carga según el rol del usuario
     */
    public function index(Request $request)
    {
        // Verificar que esté autenticado
        if (!$this->authService->isAuthenticated()) {
            return redirect()->route('login')->with('msg', 'inactive');
        }

        // Obtener datos del usuario de la sesión
        $user = $this->authService->getAuthenticatedUser();
        $message = $request->get('msg') ?? session('msg');
        
        return view('dashboard.main', compact('user', 'message'));
    }
}