<nav class="navbar navbar-expand-lg" style="background-color: #13281F; color:#f1f6e9">
  <div class="container-fluid px-4">
    <a class="navbar-brand d-flex align-items-center text-decoration-none" href="{{ route('dashboard') }}" style="color: #f1f6e9;">
      <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" height="35" class="me-2 rounded-circle">
      <span class="fw-bold">AventonesCR</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-car me-1"></i>Vehículos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('vehicles.add') }}"><i class="fas fa-plus me-1"></i>Agregar Vehículo</a></li>
            <li><a class="dropdown-item" href="{{ route('vehicles.my') }}"><i class="fas fa-list me-1"></i>Ver Mis Vehículos</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
            <i class="fas fa-route me-1"></i>Mis Rides
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="fas fa-plus me-1"></i>Crear un Ride</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-list me-1"></i>Ver Mis Rides</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-clipboard-list me-1"></i>Ver Mis Reservaciones</a></li>
          </ul>
        </li>
      </ul>

      <div class="profile d-flex align-items-center">
        <a href="{{ route('profile.edit') }}">
          @if($user['fotografia'] && file_exists(public_path($user['fotografia'])))
            <img src="{{ asset($user['fotografia']) }}" alt="Profile" class="rounded-circle border border-light" height="35" style="cursor: pointer; object-fit: cover;">
          @else
            <img src="{{ asset('assets/default-profile.png') }}" alt="Profile" class="rounded-circle border border-light" height="35" style="cursor: pointer;">
          @endif
        </a>
        
        <a href="{{ route('logout') }}" class="btn btn-success ms-3" style="background-color: #2ECC71; border-color: #2ECC71;">
          <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
        </a>
      </div>
    </div>
  </div>
</nav>