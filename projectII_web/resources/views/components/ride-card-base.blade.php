{{-- Card base para mostrar información del ride --}}
@php
    // Compatibilidad con array y objeto
    $rideData = is_array($ride) ? $ride : (array) $ride;
@endphp

<div class="card shadow border-0 h-100" 
     style="border-radius: 0.8rem; transition: transform 0.2s;"
     onmouseover="this.style.transform='translateY(-5px)'"
     onmouseout="this.style.transform='translateY(0)'">

    <div class="card-header text-white text-center" style="background-color: #2ECC71; border-radius: 0.8rem 0.8rem 0 0;">
        <h5 class="mb-0 fw-bold">{{ $rideData['nombre'] }}</h5>
    </div>
    
    <div class="card-body">
        
        <div class="mb-3 pb-3 border-bottom">
            <p class="text-muted mb-1">
                <i class="fas fa-car me-2"></i>
                <strong>Vehículo:</strong> {{ $rideData['marca'] }} {{ $rideData['modelo'] }}{{ isset($rideData['anio']) ? ' (' . $rideData['anio'] . ')' : '' }}
            </p>
            <p class="text-muted mb-0">
                <i class="fas fa-palette me-2"></i>
                <strong>Color:</strong> {{ $rideData['color'] }}
            </p>
        </div>
        
        
        <div class="mb-3 pb-3 border-bottom">
            <p class="text-muted mb-1">
                <i class="fas fa-map-marker-alt me-2 text-success"></i>
                <strong>Salida:</strong> {{ $rideData['salida'] }}
            </p>
            <p class="text-muted mb-0">
                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                <strong>Llegada:</strong> {{ $rideData['llegada'] }}
            </p>
        </div>
        
        
        <div class="mb-3 pb-3 border-bottom">
            <p class="text-muted mb-1">
                <i class="fas fa-calendar-alt me-2"></i>
                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($rideData['fecha'])->format('d/m/Y') }}
            </p>
            <p class="text-muted mb-0">
                <i class="fas fa-clock me-2"></i>
                <strong>Hora:</strong> {{ \Carbon\Carbon::parse($rideData['hora'])->format('h:i A') }}
            </p>
        </div>
        
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <i class="fas fa-users me-2"></i>
                <strong>Espacios:</strong>
                <span class="badge bg-primary">{{ $rideData['espacios'] }}</span>
            </div>
            <div>
                <h5 class="mb-0 text-success fw-bold">
                    ₡{{ number_format($rideData['costo_espacio'], 2) }}
                </h5>
            </div>
        </div>
        
        {{-- Espacio para contenido específico de cada tipo de card --}}
        <div class="mt-3">
            @if(isset($cardAction))
                {!! $cardAction !!}
            @endif
        </div>
    </div>
</div>