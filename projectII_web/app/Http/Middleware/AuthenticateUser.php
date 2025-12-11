<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthenticateUser
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function handle(Request $request, Closure $next)
    {
        if (!$this->authService->isAuthenticated()) {
            //si no hay sesion valida, redirige al login
            return redirect()->route('login')->with('msg', 'login_required');
        }

        return $next($request); //si la sesion es valida, continua
    }
}