<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\PublicRidesController;
use App\Http\Controllers\PassengerController;

// Autenticación
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Registro
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// Activación de cuenta
Route::get('/activate', [UserController::class, 'activate'])->name('activate');

// Página pública de rides (sin middleware, accesible sin autenticación)
Route::get('/public-rides', [PublicRidesController::class, 'index'])->name('public.rides');

// Dashboard único (protegido con middleware)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth.user');

// Rutas de vehículos (protegidas con middleware)
Route::middleware('auth.user')->group(function () {
    Route::get('/vehicles/add', [VehicleController::class, 'showAddForm'])->name('vehicles.add');
    Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/my', [VehicleController::class, 'myVehicles'])->name('vehicles.my');
    Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
});

// Rutas de perfil (protegidas con middleware)
Route::middleware('auth.user')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Rutas de rides (protegidas con middleware)
Route::middleware('auth.user')->group(function () {
    Route::get('/rides/add', [RideController::class, 'showAddForm'])->name('rides.add');
    Route::post('/rides/store', [RideController::class, 'store'])->name('rides.store');
    Route::get('/rides/my', [RideController::class, 'myRides'])->name('rides.my');
    Route::get('/rides/{id}/edit', [RideController::class, 'edit'])->name('rides.edit');
    Route::put('/rides/{id}', [RideController::class, 'update'])->name('rides.update');
    Route::delete('/rides/{id}', [RideController::class, 'destroy'])->name('rides.destroy');
});

// Rutas para paneles de pasajeros (protegidas con middleware)
Route::middleware('auth.user')->group(function () {
    Route::get('/passenger/search-rides', [PassengerController::class, 'searchRides'])->name('passenger.search.rides');
    Route::get('/passenger/my-reservations', [PassengerController::class, 'myReservations'])->name('passenger.reservations');
    Route::get('/passenger/my-trips', [PassengerController::class, 'myTrips'])->name('passenger.trips');
});




