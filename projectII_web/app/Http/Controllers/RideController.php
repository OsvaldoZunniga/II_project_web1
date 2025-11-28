<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RideService;
use App\Services\VehicleService;
use App\Services\AuthService;

class RideController extends Controller
{
    protected $rideService;
    protected $vehicleService;

    public function __construct(RideService $rideService, VehicleService $vehicleService)
    {
        $this->rideService = $rideService;
        $this->vehicleService = $vehicleService;
    }

    /**
     * Mostrar formulario para agregar ride
     */
    public function showAddForm()
    {
        $authService = app(AuthService::class);
        $user = $authService->getAuthenticatedUser();
        
        // Obtener vehículos del usuario
        $vehicles = $this->vehicleService->getUserVehicles();
        
        return view('dashboard.main', [
            'content' => 'driver.rides.add',
            'user' => $user,
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Procesar creación del ride
     */
    public function store(Request $request)
    {
        $result = $this->rideService->createRide($request->all());

        if ($result['success']) {
            return redirect()->route('dashboard')
                ->with('msg', 'ride_success')
                ->with('type', 'success');
        }

        return redirect()->back()
            ->with('msg', 'ride_error')
            ->with('type', 'error')
            ->withInput();
    }

    /**
     * Mostrar rides del usuario
     */
    public function myRides()
    {
        $authService = app(AuthService::class);
        $user = $authService->getAuthenticatedUser();
        $rides = $this->rideService->getUserRides();

        return view('dashboard.main', [
            'content' => 'driver.rides.list',
            'rides' => $rides,
            'user' => $user
        ]);
    }

    /**
     * Mostrar formulario para editar ride
     */
    public function edit($idRide)
    {
        $authService = app(AuthService::class);
        $user = $authService->getAuthenticatedUser();
        $idUsuario = $user['idUsuario'];
        
        // Verificar propiedad del ride
        if (!$this->rideService->verifyRideOwnership($idRide, $idUsuario)) {
            return redirect()->route('rides.my')
                ->with('msg', 'ride_not_found')
                ->with('type', 'error');
        }

        // Obtener ride por ID 
        $ride = $this->rideService->getRideById($idRide);
        
        if (!$ride) {
            $ride = $this->rideService->getRideByIdSimple($idRide);
            if (!$ride) {
                return redirect()->route('rides.my')
                    ->with('msg', 'ride_not_found')
                    ->with('type', 'error');
            }
        }
        
        // Obtener vehículos del usuario
        $vehicles = $this->vehicleService->getUserVehicles();
        
        return view('dashboard.main', [
            'content' => 'driver.rides.edit',
            'user' => $user,
            'ride' => $ride,
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Actualizar ride
     */
    public function update(Request $request, $idRide)
    {
        $result = $this->rideService->updateRide($idRide, $request->all());

        if ($result['success']) {
            return redirect()->route('rides.my')
                ->with('msg', 'ride_updated')
                ->with('type', 'success');
        }

        return redirect()->back()
            ->with('msg', 'ride_error')
            ->with('type', 'error')
            ->withInput();
    }

    /**
     * Eliminar ride
     */
    public function destroy($idRide)
    {
        $result = $this->rideService->deleteRide($idRide);

        if ($result['success']) {
            return redirect()->route('rides.my')
                ->with('msg', 'ride_deleted')
                ->with('type', 'success');
        }

        return redirect()->back()
            ->with('msg', 'ride_error')
            ->with('type', 'error');
    }
}