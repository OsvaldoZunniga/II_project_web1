{{-- Vista para mostrar rides del usuario --}}
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card fondo text-white shadow border-0" style="border-radius: 20px; min-height: 400px; box-shadow: 0 4px 24px rgba(39, 174, 96, 0.12);">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <h3 class="fw-bold mb-0" style="color: #eaf7d2;">Mis Rides</h3>
          </div>
          
          <div class="row g-4" id="rides-container">
            @if(empty($rides))
              <div class="col-12">
                <div class="text-center py-5">
                  <i class="fas fa-route fa-4x mb-3" style="color: #d6e5c0; opacity: 0.5;"></i>
                  <p class="mb-3" style="color: #d6e5c0;">No hay rides registrados aún.</p>
                  <a href="{{ route('rides.add') }}" class="btn btn-outline-light">
                    <i class="fas fa-plus me-2"></i>Crear tu primer ride
                  </a>
                </div>
              </div>
            @else
              @foreach($rides as $ride)
                @include('components.ride-card-driver', ['ride' => $ride])
              @endforeach
            @endif            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>