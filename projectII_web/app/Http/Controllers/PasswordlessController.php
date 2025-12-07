<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\PasswordlessService;

class PasswordlessController extends Controller
{
    protected $passwordlessService;

    public function __construct(PasswordlessService $passwordlessService)
    {
        $this->passwordlessService = $passwordlessService;
    }

    /**
     * Enviar link de login sin contraseña
     */
    public function sendLoginLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $result = $this->passwordlessService->sendLoginLink($request->email);

        if ($result['success']) {
            return redirect()->route('login')->with('msg', 'link_sent');
        } else {
            return redirect()->route('login')->with('msg', $result['error']);
        }
    }

    /**
     * Login usando el token del correo
     */
    public function loginWithToken($token)
    {
        $result = $this->passwordlessService->loginWithToken($token);

        if ($result['success']) {
            session([
                'idUsuario' => $result['user']->idUsuario,
                'nombre' => $result['user']->nombre,
                'correo' => $result['user']->correo,
                'fotografia' => $result['user']->fotografia,
                'idRoles' => $result['user']->idRoles,
                'authenticated' => true
            ]);

            return redirect()->route('dashboard')->with('msg', 'login_success');
        } else {
            return redirect()->route('login')->with('msg', $result['error']);
        }
    }
}
