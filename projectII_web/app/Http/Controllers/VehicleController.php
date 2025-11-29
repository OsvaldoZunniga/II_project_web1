<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\VehicleService;
use App\Services\AuthService;

class VehicleController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Mostrar formulario para agregar vehículo
     */
    public function showAddForm()
    {
        $authService = app(AuthService::class);
        $user = $authService->getAuthenticatedUser();
        
        return view('dashboard.main', [
            'content' => 'driver.vehicles.add',
            'user' => $user
        ]);
    }

    /**
     * Procesar el registro del vehículo
     */
    public function store(Request $request)
    {
        $result = $this->vehicleService->createVehicle($request->all(), $request->file('foto'));

        if ($result['success']) {
            return redirect()->route('dashboard')
                ->with('msg', 'vehicle_added')
                ->with('type', 'success');
        }

        return redirect()->back()
            ->with('msg', 'vehicle_error')
            ->with('type', 'error')
            ->withInput();
    }

    /**
     * Mostrar vehículos del usuario
     */
    public function myVehicles()
    {
        $authService = app(AuthService::class);
        $user = $authService->getAuthenticatedUser();
        $vehicles = $this->vehicleService->getUserVehicles();

        return view('dashboard.main', [
            'content' => 'driver.vehicles.list',
            'vehicles' => $vehicles,
            'user' => $user
        ]);
    }

    /**
     * Mostrar formulario para editar vehículo
     */
    public function edit($idVehiculo)
    {
        $authService = app(AuthService::class);
        $user = $authService->getAuthenticatedUser();
        $vehicle = $this->vehicleService->getVehicleById($idVehiculo);

        if (!$vehicle || $vehicle['idUsuario'] != $user['idUsuario']) {
            return redirect()->route('vehicles.my')
                ->with('msg', 'unauthorized')
                ->with('type', 'error');
        }

        return view('dashboard.main', [
            'content' => 'driver.vehicles.edit',
            'vehicle' => $vehicle,
            'user' => $user
        ]);
    }

    /**
     * Actualizar vehículo
     */
    public function update(Request $request, $idVehiculo)
    {
        $result = $this->vehicleService->updateVehicle($idVehiculo, $request->all(), $request->file('foto'));

        if ($result['success']) {
            return redirect()->route('vehicles.my')
                ->with('msg', 'vehicle_updated')
                ->with('type', 'success');
        }

        return redirect()->back()
            ->with('msg', 'vehicle_error')
            ->with('type', 'error')
            ->withInput();
    }

    /**
     * Eliminar vehículo
     */
    public function destroy($idVehiculo)
    {
        $result = $this->vehicleService->deleteVehicle($idVehiculo);

        if ($result['success']) {
            return redirect()->route('vehicles.my')
                ->with('msg', 'vehicle_deleted')
                ->with('type', 'success');
        }

        return redirect()->back()
            ->with('msg', 'vehicle_error')
            ->with('type', 'error');
    }
}