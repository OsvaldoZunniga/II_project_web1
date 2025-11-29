<?php

namespace App\Services;

use App\Models\Ride;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;

class RideService
{
    /**
     * Crear un nuevo ride
     */
    public function createRide(array $data): array
    {
        try {
            $idUsuario = Session::get('idUsuario');

            if (!$idUsuario) {
                return ['success' => false, 'message' => 'Usuario no autenticado'];
            }

            // Verificar que el vehículo pertenece al usuario
            $vehicle = Vehicle::where('idVehiculo', $data['vehiculo'])
                             ->where('idUsuario', $idUsuario)
                             ->first();

            if (!$vehicle) {
                return ['success' => false, 'message' => 'Vehículo no válido'];
            }

            // Crear ride
            $ride = Ride::create([
                'idVehiculo' => $data['vehiculo'],
                'nombre' => $data['nombre'],
                'salida' => $data['salida'],
                'llegada' => $data['llegada'],
                'hora' => $data['hora'],
                'fecha' => $data['fecha'],
                'espacios' => $data['espacios'],
                'costo_espacio' => $data['precio_espacio']
            ]);

            return ['success' => true, 'ride' => $ride];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Obtener rides del usuario autenticado
     */
    public function getUserRides(): array
    {
        $idUsuario = Session::get('idUsuario');

        if (!$idUsuario) {
            return [];
        }

        return Ride::select([
                'r.idRide',
                'r.idVehiculo',
                'r.nombre',
                'r.salida',
                'r.llegada',
                'r.hora',
                'r.fecha',
                'r.espacios',
                'r.costo_espacio',
                'v.marca',
                'v.modelo',
                'v.color'
            ])
            ->from('ride as r')
            ->join('vehiculos as v', 'r.idVehiculo', '=', 'v.idVehiculo')
            ->join('usuarios as u', 'v.idUsuario', '=', 'u.idUsuario')
            ->where('u.idUsuario', $idUsuario)
            ->where('u.estado', 'Activo')
            ->whereNotNull('v.idVehiculo')
            ->orderBy('r.idRide', 'DESC')
            ->get()
            ->toArray();
    }

    /**
     * Obtener ride por ID
     */
    public function getRideById($idRide): ?array
    {
        $ride = Ride::select([
                'r.idRide',
                'r.idVehiculo',
                'r.nombre',
                'r.salida',
                'r.llegada',
                'r.hora',
                'r.fecha',
                'r.espacios',
                'r.costo_espacio',
                'v.marca',
                'v.modelo',
                'v.color'
            ])
            ->from('ride as r')
            ->join('vehiculos as v', 'r.idVehiculo', '=', 'v.idVehiculo')
            ->join('usuarios as u', 'v.idUsuario', '=', 'u.idUsuario')
            ->where('r.idRide', $idRide)
            ->where('u.estado', 'Activo')
            ->whereNotNull('v.idVehiculo')
            ->first();

        return $ride ? $ride->toArray() : null;
    }

    /**
     * Obtener ride por ID
     */
    public function getRideByIdSimple($idRide): ?array
    {
        $ride = Ride::where('idRide', $idRide)->first();
        return $ride ? $ride->toArray() : null;
    }

    /**
     * Verificar que el ride pertenece al usuario
     */
    public function verifyRideOwnership($idRide, $idUsuario): bool
    {
        // Obtener ride directamente
        $ride = $this->getRideByIdSimple($idRide);
        if (!$ride) {
            return false;
        }

        // Verificar que el vehículo pertenece al usuario
        $vehicle = Vehicle::where('idVehiculo', $ride['idVehiculo'])
                         ->where('idUsuario', $idUsuario)
                         ->first();

        return $vehicle !== null;
    }

    /**
     * Actualizar un ride
     */
    public function updateRide($idRide, array $data): array
    {
        try {
            $idUsuario = Session::get('idUsuario');

            if (!$idUsuario) {
                return ['success' => false, 'message' => 'Usuario no autenticado'];
            }

            // Verificar propiedad del ride de manera directa
            if (!$this->verifyRideOwnership($idRide, $idUsuario)) {
                return ['success' => false, 'message' => 'No tienes permisos para este ride'];
            }

            // Verificar que el vehículo nuevo pertenece al usuario
            $vehicle = Vehicle::where('idVehiculo', $data['vehiculo'])
                             ->where('idUsuario', $idUsuario)
                             ->first();

            if (!$vehicle) {
                return ['success' => false, 'message' => 'Vehículo no válido'];
            }

            // Actualizar ride directamente
            $updated = Ride::where('idRide', $idRide)
                          ->update([
                              'idVehiculo' => $data['vehiculo'],
                              'nombre' => $data['nombre'],
                              'salida' => $data['salida'],
                              'llegada' => $data['llegada'],
                              'hora' => $data['hora'],
                              'fecha' => $data['fecha'],
                              'espacios' => $data['espacios'],
                              'costo_espacio' => $data['precio_espacio']
                          ]);

            return ['success' => $updated > 0];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Eliminar un ride (AQUI FALTA AGREGAR QUE SE ELIMINEN TAMBIEN LAS RESERVACIONES ASOCIADAS AL RIDE)
     */
    public function deleteRide($idRide): array
    {
        try {
            $idUsuario = Session::get('idUsuario');

            if (!$idUsuario) {
                return ['success' => false, 'message' => 'Usuario no autenticado'];
            }

            // Verificar propiedad del ride de manera directa
            if (!$this->verifyRideOwnership($idRide, $idUsuario)) {
                return ['success' => false, 'message' => 'No tienes permisos para este ride'];
            }

            // Eliminar ride directamente
            $deleted = Ride::where('idRide', $idRide)->delete();

            return ['success' => $deleted > 0];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Obtener rides disponibles para pasajeros con filtros y orden
     */
    public function obtenerRidesDisponibles($filtros = [], $orden = 'fecha_asc'): array
    {
        try {
            $query = Ride::select([
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
            ->from('ride as r')
            ->join('vehiculos as v', 'r.idVehiculo', '=', 'v.idVehiculo')
            ->join('usuarios as u', 'v.idUsuario', '=', 'u.idUsuario')
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

            return $query->get()->toArray();

        } catch (\Exception $e) {
            return [];
        }
    }
}