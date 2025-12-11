<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\RideService;

class PublicRidesController extends Controller
{
    private $rideService;
    public function __construct(RideService $ridesServices)
    {
        $this->rideService = $ridesServices;
    }
    public function index(Request $request)
    {
        // Obtener filtros del request
        $filtros = [
            'salida' => $request->get('salida', ''),
            'llegada' => $request->get('llegada', '')
        ];
        
        $orden = $request->get('orden', 'fecha_asc');
        
        // Obtener rides públicos
        $rides = $this->rideService->obtenerRidesDisponibles($filtros, $orden);
        
        return view('public.rides', compact('rides', 'filtros', 'orden'));
    }
    
    
    
}
