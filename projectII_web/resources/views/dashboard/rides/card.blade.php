{{-- Card para mostrar ride individual --}}
<div class="col-md-4 mb-4">
  <a href="{{ route('rides.edit', $ride['idRide']) }}" class="text-decoration-none">
    <div class="card shadow border-0 h-100" 
         style="border-radius: 0.8rem; transition: transform 0.2s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15), 0 1px 3px rgba(0, 0, 0, 0.1) !important;"
         onmouseover="this.style.transform='translateY(-5px)'"
         onmouseout="this.style.transform='translateY(0)'">

      <div class="card-header text-white text-center" style="background-color: #2ECC71; border-radius: 0.8rem 0.8rem 0 0;">
        <h5 class="mb-0 fw-bold">{{ $ride['nombre'] }}</h5>
      </div>
      
      <div class="card-body">
        
        <div class="mb-3 pb-3 border-bottom">
          <p class="text-muted mb-1">
            <i class="fas fa-car me-2"></i>
            <strong>Vehículo:</strong> {{ $ride['marca'] }} {{ $ride['modelo'] }}
          </p>
          <p class="text-muted mb-0">
            <i class="fas fa-palette me-2"></i>
            <strong>Color:</strong> {{ $ride['color'] }}
          </p>
        </div>
        
        
        <div class="mb-3 pb-3 border-bottom">
          <p class="text-muted mb-1">
            <i class="fas fa-map-marker-alt me-2 text-success"></i>
            <strong>Salida:</strong> {{ $ride['salida'] }}
          </p>
          <p class="text-muted mb-0">
            <i class="fas fa-map-marker-alt me-2 text-danger"></i>
            <strong>Llegada:</strong> {{ $ride['llegada'] }}
          </p>
        </div>
        
        
        <div class="mb-3 pb-3 border-bottom">
          <p class="text-muted mb-1">
            <i class="fas fa-calendar-alt me-2"></i>
            <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($ride['fecha'])->format('d/m/Y') }}
          </p>
          <p class="text-muted mb-0">
            <i class="fas fa-clock me-2"></i>
            <strong>Hora:</strong> {{ \Carbon\Carbon::parse($ride['hora'])->format('h:i A') }}
          </p>
        </div>
        
        
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <i class="fas fa-users me-2"></i>
            <strong>Espacios:</strong>
            <span class="badge bg-primary">{{ $ride['espacios'] }}</span>
          </div>
          <div>
            <h5 class="mb-0 text-success fw-bold">
              ₡{{ number_format($ride['costo_espacio'], 2) }}
            </h5>
          </div>
        </div>
        
        <div class="mt-3">
          <small class="text-muted">
            <i class="fas fa-edit me-1"></i>Haz clic para editar este ride
          </small>
        </div>
      </div>
    </div>
  </a>
</div>