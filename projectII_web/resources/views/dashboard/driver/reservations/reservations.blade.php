@php
    $list = is_array($bookings) ? $bookings : (array) $bookings;
@endphp

@if(empty($list))
    <div class="col-12">
        <div class="alert alert-info small">No hay reservas.</div>
    </div>
@else
    <div class="row gx-2 gy-3">
        @foreach($list as $b)
            @php
                $estado = strtolower($b['estado'] ?? '');
                if ($estado === 'pendiente') {
                    $badgeClass = 'bg-warning text-dark';
                } elseif ($estado === 'aceptado') {
                    $badgeClass = 'bg-success text-white';
                } elseif ($estado === 'cancelada') {
                    $badgeClass = 'bg-danger text-white';
                } else {
                    $badgeClass = 'bg-secondary text-white';
                }
            @endphp

            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100 border-0 shadow" style="box-shadow: 0 4px 6px rgba(0,0,0,0.15), 0 1px 3px rgba(0,0,0,0.1); max-width: 400px;">
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 text-truncate fw-bold">{{ $b['ride_nombre'] ?? 'Ride' }}</h6>
                            <span class="badge {{ $badgeClass }} small">{{ $b['estado'] ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-1 text-muted small">
                            {{ ($b['nombre'] ?? '') . ' ' . ($b['apellido'] ?? '') }}
                            @if(!empty($b['cedula'])) · <span class="text-monospace">{{ $b['cedula'] }}</span> @endif
                        </div>
                        <div class="mb-2 text-muted small">
                            <i class="far fa-calendar-alt me-1"></i> {{ isset($b['fecha']) ? \Carbon\Carbon::parse($b['fecha'])->format('Y-m-d') : '—' }}
                            <i class="far fa-clock ms-2 me-1"></i> {{ $b['hora'] ?? '—' }}
                        </div>
                        <div class="mt-auto d-flex justify-content-end gap-2">
                            <form method="POST" action="#', $b['idReserva']) }}">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm px-3">Aceptar</button>
                            </form>
                            <form method="POST" action="#', $b['idReserva']) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm px-3">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif