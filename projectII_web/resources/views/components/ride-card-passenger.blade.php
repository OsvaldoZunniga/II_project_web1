{{-- Card para pasajero (con botón de reservar) --}}
@php
    $rideData = is_array($ride) ? $ride : (array) $ride;
@endphp

<div class="col-md-4 mb-4">
    @include('components.ride-card-base', [
        'ride' => $ride,
        'cardAction' => '<form action="#" method="post" onsubmit="alert(\'Funcionalidad de reservas pendiente\'); return false;">
                            <input type="hidden" name="ride_id" value="' . $rideData['idRide'] . '">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check-circle me-2"></i> Reservar Ride
                            </button>
                        </form>'
    ])
</div>