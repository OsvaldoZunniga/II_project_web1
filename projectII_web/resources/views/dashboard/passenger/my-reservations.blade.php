<div class="table-responsive my-4 mx-4">
    <table class="table table-striped table-hover">
        <thead style="background-color: #2ECC71; color: #fffde8;">
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
        <tbody style="background-color: #fffde8; color: #13281F;">
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
                    <td colspan="10" class="text-center">No tienes solicitudes de reserva</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>