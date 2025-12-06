{{-- Card para mostrar información de auditoría --}}
@php
    $auditData = is_array($audit) ? $audit : (array) $audit;
@endphp

<div class="card shadow border-0 h-100"
     style="border-radius: 0.8rem; transition: transform 0.2s;"
     onmouseover="this.style.transform='translateY(-5px)'"
     onmouseout="this.style.transform='translateY(0)'">

    <div class="card-header text-white text-center" style="background-color: #2ECC71; border-radius: 0.8rem 0.8rem 0 0;">
        <h5 class="mb-0 fw-bold">
            Auditoría de Búsqueda
        </h5>
    </div>

    <div class="card-body">

        <div class="mb-3 pb-3 border-bottom">
            <p class="text-muted mb-1">
                <i class="fas fa-user me-2"></i>
                <strong>Usuario ID:</strong> {{ $auditData['idUsuario'] }}
            </p>
            @if(isset($auditData['user']) && isset($auditData['user']['nombre']))
            <p class="text-muted mb-0">
                <i class="fas fa-user-circle me-2"></i>
                <strong>Nombre:</strong> {{ $auditData['user']['nombre'] }} {{ $auditData['user']['apellido'] ?? '' }}
            </p>
            @endif
        </div>

        <div class="mb-3 pb-3 border-bottom">
            <p class="text-muted mb-1">
                <i class="fas fa-map-marker-alt me-2 text-success"></i>
                <strong>Salida:</strong> {{ $auditData['salida'] }}
            </p>
            <p class="text-muted mb-0">
                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                <strong>Llegada:</strong> {{ $auditData['llegada'] }}
            </p>
        </div>

        <div class="mb-3 pb-3 border-bottom">
            <p class="text-muted mb-1">
                <i class="fas fa-calendar-alt me-2"></i>
                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($auditData['fecha'])->format('d/m/Y') }}
            </p>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <i class="fas fa-list-ol me-2"></i>
                <strong>Resultados:</strong>
                <span class="badge bg-primary">{{ $auditData['cantidadResultados'] }}</span>
            </div>
        </div>
    </div>
</div>