<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RideService;
use App\Services\AuditService;

class PublicRidesController extends Controller
{
    protected $rideService;
    protected $auditService;

    public function __construct(RideService $rideService, AuditService $auditService)
    {
        $this->rideService = $rideService;
        $this->auditService = $auditService;
    }

    /**
     * Mostrar página pública de rides disponibles
     */
    public function index(Request $request)
    {
        // Obtener filtros del request
        $filtros = [
            'salida' => $request->get('salida', ''),
            'llegada' => $request->get('llegada', '')
        ];
        
        $orden = $request->get('orden', 'fecha_asc');
        
        // Usar el mismo servicio que usa PassengerController 
        $rides = collect($this->rideService->obtenerRidesDisponibles($filtros, $orden));
    
        
        return view('public.rides', compact('rides', 'filtros', 'orden'));
    }
}
