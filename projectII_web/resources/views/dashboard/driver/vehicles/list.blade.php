{{-- Lista de vehículos del usuario --}}
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card fondo text-white shadow border-0" style="border-radius: 20px; min-height: 400px; box-shadow: 0 4px 24px rgba(39, 174, 96, 0.12);">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <h3 class="fw-bold mb-0" style="color: #eaf7d2;">Mis Vehículos</h3>
          </div>
          
          <div class="row g-4" id="vehiculos-container">
            @if(empty($vehicles))
              <div class="col-12">
                <div class="text-center py-5">
                  <i class="fas fa-car fa-4x mb-3" style="color: #d6e5c0; opacity: 0.5;"></i>
                  <p class="mb-3" style="color: #d6e5c0;">No hay vehículos registrados aún.</p>
                  <a href="{{ route('vehicles.add') }}" class="btn btn-outline-light">
                    <i class="fas fa-plus me-2"></i>Registrar tu primer vehículo
                  </a>
                </div>
              </div>
            @else
              @foreach($vehicles as $vehicle)
                @include('dashboard.driver.vehicles.card', ['vehiculo' => $vehicle])
              @endforeach
            @endif
          </div>
          
          <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
              <i class="fas fa-arrow-left me-2"></i>Volver al Dashboard
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>