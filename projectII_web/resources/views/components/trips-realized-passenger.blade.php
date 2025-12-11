

<div class="card shadow border-0 h-100"
     style="border-radius: 0.8rem; transition: transform 0.2s;"
     onmouseover="this.style.transform='translateY(-5px)'"
     onmouseout="this.style.transform='translateY(0)'">

    <div class="card-header text-white text-center" style="background-color: #2ECC71; border-radius: 0.8rem 0.8rem 0 0;">
        <h5 class="mb-0 fw-bold">
            {{ $ride['ride_nombre'] ?? 'Viaje Realizado' }}
        </h5>
    </div>
    
    <div class="card-body">
        <div class="mb-3 pb-3 border-bottom">
            <p class="text-muted mb-1">
                <i class="fas fa-map-marker-alt me-2 text-success"></i>
                <strong>Salida:</strong> {{ $ride['salida'] ?? 'N/A' }}
            </p>
            <p class="text-muted mb-0">
                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                <strong>Llegada:</strong> {{ $ride['llegada'] ?? 'N/A' }}
            </p>
        </div>
        
        <div class="mb-3 pb-3 border-bottom">
            <p class="text-muted mb-1">
                <i class="fas fa-calendar-alt me-2"></i>
                <strong>Fecha:</strong> {{ isset($ride['fecha']) ? \Carbon\Carbon::parse($ride['fecha'])->format('d/m/Y') : 'N/A' }}
            </p>
            <p class="text-muted mb-0">
                <i class="fas fa-clock me-2"></i>
                <strong>Hora:</strong> {{ isset($ride['hora']) ? \Carbon\Carbon::parse($ride['hora'])->format('h:i A') : 'N/A' }}
            </p>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <i class="fas fa-users me-2"></i>
                <strong>Espacios:</strong>
                <span class="badge bg-primary">{{ $ride['espacios'] ?? 'N/A' }}</span>
            </div>
            <div>
                <h5 class="mb-0 text-success fw-bold">
                    ₡{{ isset($ride['costo_espacio']) ? number_format($ride['costo_espacio'], 2) : 'N/A' }}
                </h5>
            </div>
        </div>
        <div class="mt-3">
            <span class="badge bg-success">Completado</span>
        </div>
    </div>
</div>