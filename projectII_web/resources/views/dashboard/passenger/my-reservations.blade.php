<div class="table-responsive my-2 mx-auto px-2" style="max-width: 1600px;">
    <table class="table table-striped table-hover table-sm small">
        <thead style="background-color: #2ECC71; color: #fffde8; font-size: .9rem;">
            <tr>
                <th>ID Reserva</th>
                <th>Ride</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Hora</th>                
                <th>Acción</th>
            </tr>
        </thead>
        <tbody style="background-color: #fffde8; color: #13281F; font-size: .9rem;">
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->idReserva }}</td>
                    <td>{{ $booking->ride->nombre ?? 'N/A' }}</td>
                    <td>{{ $booking->ride->salida ?? 'N/A' }}</td>
                    <td>{{ $booking->ride->llegada ?? 'N/A' }}</td>
                    <td>{{ $booking->ride->fecha ? $booking->ride->fecha->format('Y-m-d') : 'N/A' }}</td>
                    <td>{{ $booking->ride->hora ?? 'N/A' }}</td>
                    
                    <td>
                        <form method="POST" action="{{ route('bookings.cancel', $booking->idReserva) }}" style="display:inline;">
                            @csrf
                            <button 
                                type="submit" 
                                class="btn btn-danger btn-sm" 
                                {{ ($booking->estado !== 'Pendiente' && $booking->estado !== 'Aceptado') ? 'disabled' : '' }}
                            >
                                Cancelar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No tienes solicitudes de reserva</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>