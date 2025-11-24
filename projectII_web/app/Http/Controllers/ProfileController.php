<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfileService;
use App\Services\AuthService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Mostrar formulario para editar perfil
     */
    public function edit()
    {
        $authService = app(AuthService::class);
        $user = $authService->getAuthenticatedUser();
        $profileData = $this->profileService->getUserProfile($user['idUsuario']);

        return view('dashboard.main', [
            'content' => 'profile.edit',
            'user' => $user,
            'profileData' => $profileData
        ]);
    }

    /**
     * Actualizar datos del perfil
     */
    public function update(Request $request)
    {
        $authService = app(AuthService::class);
        $user = $authService->getAuthenticatedUser();
        
        $result = $this->profileService->updateProfile(
            $user['idUsuario'], 
            $request->all(), 
            $request->file('fotografia')
        );

        if ($result['success']) {
            // Actualizar datos en sesión si se cambiaron
            if (isset($result['updateSession'])) {
                $authService->updateSessionData($result['updateSession']);
            }
            
            return redirect()->route('dashboard')
                ->with('msg', 'profile_updated')
                ->with('type', 'success');
        }

        return redirect()->back()
            ->with('msg', $result['message'])
            ->with('type', 'error')
            ->withInput();
    }
}