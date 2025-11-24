<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Mostrar formulario de registro
     */
    public function showRegister(Request $request)
    {
        $message = $request->get('msg');
        return view('auth.register', compact('message'));
    }

    /**
     * Procesar el registro de usuario
     * Solo coordina, delega la lógica al servicio
     */
    public function store(Request $request)
    {
        try {
            // Preparar datos del request
            $data = $request->all();
            if ($request->hasFile('fotografia')) {
                $data['fotografia'] = $request->file('fotografia');
            }

            // Delegar al servicio
            $result = $this->userService->registerUser($data);

            // Redirigir según resultado
            if ($result === 'pending') {
                return redirect()->route('login')->with('msg', 'pending');
            } else {
                return redirect()->route('register')->with('msg', $result);
            }
            
        } catch (\Exception $e) {
            // Log del error
            error_log("Error en registro: " . $e->getMessage());
            return redirect()->route('register')->with('msg', 'error_general');
        }
    }

    /**
     * Activar cuenta de usuario
     * Solo coordina, delega la lógica al servicio
     */
    public function activate(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');

        if (!$email || !$token) {
            return redirect()->route('login')->with('msg', 'invalid');
        }

        $result = $this->userService->activateUser($email, $token);
        
        return redirect()->route('login')->with('msg', $result);
    }
}