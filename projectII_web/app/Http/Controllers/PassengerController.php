<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RideService;
use App\Services\AuthService;

class PassengerController extends Controller
{
    protected $rideService;
    protected $authService;

    public function __construct(RideService $rideService, AuthService $authService)
    {
        $this->rideService = $rideService;
        $this->authService = $authService;
    }

    /**
     * Mostrar panel de búsqueda de rides para pasajeros
     */
    public function searchRides(Request $request)
    {
        // Obtener datos del usuario autenticado
        $user = $this->authService->getAuthenticatedUser();
        
        // Obtener filtros del request
        $filtros = [
            'salida' => $request->get('salida', ''),
            'llegada' => $request->get('llegada', '')
        ];
        
        $orden = $request->get('orden', 'fecha_asc');
        
        // Obtener rides disponibles usando el service
        $rides = collect($this->rideService->obtenerRidesDisponibles($filtros, $orden));
        
        // Devolver vista del dashboard main con el contenido de búsqueda
        return view('dashboard.main', [
            'content' => 'passenger.search-rides',
            'user' => $user,
            'rides' => $rides,
            'filtros' => $filtros,
            'orden' => $orden
        ]);
    }
}