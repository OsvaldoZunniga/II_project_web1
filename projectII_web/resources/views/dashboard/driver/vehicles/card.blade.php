{{-- Card individual para cada vehículo --}}
<div class="col-md-3">
  <a href="{{ route('vehicles.edit', $vehiculo['idVehiculo']) }}" class="text-decoration-none vehicle-card" data-id="{{ $vehiculo['idVehiculo'] }}">
    <div class="card shadow border-0 h-100 card-clickable" 
         style="border-radius: 0.8rem; 
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15), 0 1px 3px rgba(0, 0, 0, 0.1) !important; 
                transition: transform 0.2s, box-shadow 0.2s;
                background-color: #fff;">
      
      @if(!empty($vehiculo['foto']))
        <img src="{{ asset($vehiculo['foto']) }}" 
             class="card-img-top" 
             alt="{{ $vehiculo['marca'] }} {{ $vehiculo['modelo'] }}"
             style="height: 200px; object-fit: cover; border-radius: 0.8rem 0.8rem 0 0;">
      @else
        <div class="bg-light d-flex align-items-center justify-content-center" 
             style="height: 200px; border-radius: 0.8rem 0.8rem 0 0;">
          <i class="fas fa-car fa-3x text-muted"></i>
        </div>
      @endif
      
      <div class="card-body text-center">
        <h5 class="fw-bold mb-3" style="color: #1A281E;">
          {{ $vehiculo['marca'] }} {{ $vehiculo['modelo'] }}
        </h5>
        <p class="text-muted mb-1">
          <strong>Placa:</strong> {{ $vehiculo['placa'] }}
        </p>
        <p class="text-muted mb-1">
          <strong>Color:</strong> {{ $vehiculo['color'] }}
        </p>
        <p class="text-muted mb-1">
          <strong>Año:</strong> {{ $vehiculo['anio'] }}
        </p>
        <p class="text-muted mb-1">
          <strong>Capacidad:</strong> {{ $vehiculo['capacidad'] }} asientos
        </p>
      </div>
      
      <div class="card-footer bg-transparent border-top text-center">
        <small class="text-muted">
          <i class="fas fa-cog me-1"></i>Configurar vehículo
        </small>
      </div>
    </div>
  </a>
</div>

<style>
.card-clickable:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2), 0 3px 6px rgba(0, 0, 0, 0.15) !important;
}

.vehicle-card {
  color: inherit;
}

.vehicle-card:hover {
  color: inherit;
  text-decoration: none;
}
</style>