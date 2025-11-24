<?php

namespace App\Services;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VehicleService
{
    /**
     * Crear un nuevo vehículo
     */
    public function createVehicle(array $data, $foto = null): array
    {
        try {
            $idUsuario = Session::get('idUsuario');

            // Validar datos básicos
            if (!$idUsuario) {
                return ['success' => false, 'message' => 'Usuario no autenticado'];
            }

            // Procesar la foto si existe
            $fotoPath = '';
            if ($foto && $foto->isValid()) {
                $fotoPath = $this->uploadVehiclePhoto($foto);
            }

            // Crear vehículo
            $vehicle = Vehicle::create([
                'idUsuario' => $idUsuario,
                'placa' => $data['placa'],
                'color' => $data['color'],
                'marca' => $data['marca'],
                'modelo' => $data['modelo'],
                'anio' => $data['anio'],
                'capacidad' => $data['capacidad'],
                'foto' => $fotoPath
            ]);

            return ['success' => true, 'vehicle' => $vehicle];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Obtener vehículos del usuario autenticado
     */
    public function getUserVehicles(): array
    {
        $idUsuario = Session::get('idUsuario');

        if (!$idUsuario) {
            return [];
        }

        return Vehicle::select([
                'v.idVehiculo', 
                'v.placa', 
                'v.color', 
                'v.marca', 
                'v.modelo', 
                'v.anio', 
                'v.capacidad', 
                'v.foto'
            ])
            ->from('vehiculos as v')
            ->join('usuarios as u', 'v.idUsuario', '=', 'u.idUsuario')
            ->where('v.idUsuario', $idUsuario)
            ->where('u.estado', 'Activo')
            ->orderBy('v.idVehiculo', 'DESC')
            ->get()
            ->toArray();
    }

    /**
     * Obtener vehículo por ID
     */
    public function getVehicleById($idVehiculo): ?array
    {
        $vehicle = Vehicle::select([
                'v.idVehiculo', 
                'v.idUsuario',
                'v.placa', 
                'v.color', 
                'v.marca', 
                'v.modelo', 
                'v.anio', 
                'v.capacidad', 
                'v.foto'
            ])
            ->from('vehiculos as v')
            ->join('usuarios as u', 'v.idUsuario', '=', 'u.idUsuario')
            ->where('v.idVehiculo', $idVehiculo)
            ->where('u.estado', 'Activo')
            ->first();

        return $vehicle ? $vehicle->toArray() : null;
    }

    /**
     * Actualizar vehículo
     */
    public function updateVehicle($idVehiculo, array $data, $foto = null): array
    {
        try {
            $idUsuario = Session::get('idUsuario');
            
            // Verificar que el vehículo pertenece al usuario
            $vehicle = $this->getVehicleById($idVehiculo);
            if (!$vehicle || $vehicle['idUsuario'] != $idUsuario) {
                return ['success' => false, 'message' => 'Vehículo no encontrado o no autorizado'];
            }

            // Procesar nueva foto si existe
            $fotoPath = $vehicle['foto']; // Mantener foto actual por defecto
            if ($foto && $foto->isValid()) {
                // Eliminar foto anterior si existe
                if (!empty($vehicle['foto']) && file_exists(public_path($vehicle['foto']))) {
                    unlink(public_path($vehicle['foto']));
                }
                $fotoPath = $this->uploadVehiclePhoto($foto);
            }

            // Actualizar vehículo
            $updated = Vehicle::where('idVehiculo', $idVehiculo)
                ->update([
                    'placa' => $data['placa'],
                    'color' => $data['color'],
                    'marca' => $data['marca'],
                    'modelo' => $data['modelo'],
                    'anio' => $data['anio'],
                    'capacidad' => $data['capacidad'],
                    'foto' => $fotoPath
                ]);

            return ['success' => true];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Eliminar vehículo
     */
    public function deleteVehicle($idVehiculo): array
    {
        try {
            $idUsuario = Session::get('idUsuario');
            
            // Verificar que el vehículo pertenece al usuario
            $vehicle = $this->getVehicleById($idVehiculo);
            if (!$vehicle || $vehicle['idUsuario'] != $idUsuario) {
                return ['success' => false, 'message' => 'Vehículo no encontrado o no autorizado'];
            }

            // Eliminar reservas asociadas a los rides del vehículo
            \DB::statement('DELETE FROM reserva WHERE idRide IN (SELECT idRide FROM ride WHERE idVehiculo = ?)', [$idVehiculo]);
            
            // Eliminar rides asociados al vehículo
            \DB::statement('DELETE FROM ride WHERE idVehiculo = ?', [$idVehiculo]);

            // Eliminar foto si existe
            if (!empty($vehicle['foto']) && file_exists(public_path($vehicle['foto']))) {
                unlink(public_path($vehicle['foto']));
            }

            // Eliminar vehículo
            Vehicle::where('idVehiculo', $idVehiculo)->delete();

            return ['success' => true];

        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Subir foto del vehículo
     */
    private function uploadVehiclePhoto($foto): string
    {
        $carpeta = 'assets/';
        
        // Crear directorio si no existe
        if (!file_exists(public_path($carpeta))) {
            mkdir(public_path($carpeta), 0755, true);
        }

        $nuevoNombre = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path($carpeta), $nuevoNombre);

        return $carpeta . $nuevoNombre;
    }
}