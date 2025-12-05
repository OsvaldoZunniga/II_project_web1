{{-- Card para chofer (con enlace para editar) --}}
@php
    $rideData = is_array($ride) ? $ride : (array) $ride;
@endphp

<div class="col-md-4 mb-4">
    <a href="{{ route('rides.edit', $rideData['idRide']) }}" class="text-decoration-none">
        <div style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15), 0 1px 3px rgba(0, 0, 0, 0.1) !important;">
            @include('components.ride-card-base', [
                'ride' => $ride,
                'cardAction' => '<small class="text-muted">
                                    <i class="fas fa-edit me-1"></i>Haz clic para editar este ride
                                </small>'
            ])
        </div>
    </a>
    <a href="{{ route('rides.start', $rideData['idRide']) }}" class="btn btn-success w-100 mt-2">
        <i class="fas fa-play me-2"></i>Iniciar Ride
    </a>
</div>