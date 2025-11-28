{{-- Card para página pública (con modal) --}}
<div class="col-md-4 mb-4">
    <div style="cursor: pointer;" onclick="mostrarAlertaRegistro()">
        @include('components.ride-card-base', [
            'ride' => $ride,
            'cardAction' => '<div class="alert alert-info alert-sm mb-0" role="alert">
                                <small><i class="fas fa-click me-1"></i>Haz clic para reservar este ride</small>
                            </div>'
        ])
    </div>
</div>