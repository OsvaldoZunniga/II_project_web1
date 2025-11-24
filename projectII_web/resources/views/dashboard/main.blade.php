<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
    <!-- Alertas -->
    @if(session('msg'))
        @php
            $msg = session('msg');
        @endphp
        <div class="container mt-3">
            @if($msg == 'ride_error')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Ride no registrado. Por favor, intenta de nuevo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'ride_success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Ride registrado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'vehicle_added')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>Vehículo registrado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'vehicle_error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>Error al procesar el vehículo. Intenta de nuevo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'vehicle_updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>Vehículo actualizado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'vehicle_deleted')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>Vehículo eliminado exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'unauthorized')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>No tienes permisos para acceder a ese vehículo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'profile_updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>Tus datos han sido actualizados correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'password_mismatch')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>Las contraseñas no coinciden. Por favor, intenta de nuevo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'update_error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>Algo salió mal al actualizar tus datos. Por favor, intenta de nuevo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    @endif

    <!-- Cargar NAV según el rol -->
    @switch($user['idRoles'])
        @case(1)
            @include('dashboard.navs.nav-chofer')
            @break
        @case(2)
            @include('dashboard.navs.nav-pasajero')
            @break
        @case(3)
            @include('dashboard.navs.nav-admin')
            @break
        @default
            <div class="alert alert-danger">Rol no reconocido.</div>
    @endswitch

    <!-- Contenido principal del dashboard -->
    <div class="container-fluid mt-4">
        @if(isset($content))
            {{-- Cargar contenido específico --}}
            @include('dashboard.' . $content)
        @else
            {{-- Dashboard por defecto --}}
            <div class="text-center">
                <div class="card fondo text-white shadow border-0">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-4" style="color: #eaf7d2;">
                            Bienvenido, {{ $user['nombre'] }}
                        </h2>
                        <p class="mb-0" style="color: #d6e5c0;">
                            Usa el menú de navegación para acceder a las diferentes funciones.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>