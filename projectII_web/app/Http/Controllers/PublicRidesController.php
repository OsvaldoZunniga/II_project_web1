<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicRidesController extends Controller
{
    public function index(Request $request)
    {
        // Obtener filtros del request
        $filtros = [
            'salida' => $request->get('salida', ''),
            'llegada' => $request->get('llegada', '')
        ];
        
        $orden = $request->get('orden', 'fecha_asc');
        
        // Obtener rides públicos
        $rides = $this->obtenerRidesPublicos($filtros, $orden);
        
        return view('public.rides', compact('rides', 'filtros', 'orden'));
    }
    
    private function obtenerRidesPublicos($filtros = [], $orden = 'fecha_asc')
    {
        $query = DB::table('ride as r')
            ->join('vehiculos as v', 'r.idVehiculo', '=', 'v.idVehiculo')
            ->join('usuarios as u', 'v.idUsuario', '=', 'u.idUsuario')
            ->select([
                'r.idRide',
                'r.nombre',
                'r.salida',
                'r.llegada',
                'r.hora',
                'r.fecha',
                'r.espacios',
                'r.estado',
                'r.costo_espacio',
                'v.marca',
                'v.modelo',
                'v.anio',
                'v.color'
            ])
            ->where('u.estado', '=', 'Activo')
            ->where('r.estado', '!=', 'Realizado')
            ->whereNotNull('v.idVehiculo');
        
        // Aplicar filtros
        if (!empty($filtros['salida'])) {
            $query->where('r.salida', 'LIKE', '%' . $filtros['salida'] . '%');
        }
        
        if (!empty($filtros['llegada'])) {
            $query->where('r.llegada', 'LIKE', '%' . $filtros['llegada'] . '%');
        }
        
        // Aplicar ordenamiento
        switch ($orden) {
            case 'fecha_desc':
                $query->orderBy('r.fecha', 'desc')->orderBy('r.hora', 'desc');
                break;
            case 'salida_asc':
                $query->orderBy('r.salida', 'asc');
                break;
            case 'salida_desc':
                $query->orderBy('r.salida', 'desc');
                break;
            case 'llegada_asc':
                $query->orderBy('r.llegada', 'asc');
                break;
            case 'llegada_desc':
                $query->orderBy('r.llegada', 'desc');
                break;
            default:
                $query->orderBy('r.fecha', 'asc')->orderBy('r.hora', 'asc');
                break;
        }
        
        return $query->get();
    }
}
