<?php

    namespace App\Services;
    use App\Models\Booking;
    use App\Models\Ride;
    use Illuminate\Support\Facades\DB;



    class BookingService
    {
        /**
         * Crear una nueva reserva
         */
        public function createBooking($idUsuario, $rideId): array
        {
            
            // Crear la reserva
            $booking = new Booking();
            $booking->idUsuario = $idUsuario;
            $booking->idRide = $rideId;
            $booking->save();

            return ['success' => true, 'booking_id' => $booking->id];
        }
        /*Obtiene bookings por usuario*/
        public function getBookingsByUser($idUsuario)
        {
            return Booking::
                            where('idUsuario', $idUsuario)
                            ->whereHas('ride', function($q){
                                    $q->whereRaw('LOWER(estado) <> ?', ['realizado'])
                                        ->whereDate('fecha', '>=', now()->toDateString());
                            })
                            ->with('ride')
                            ->get();
        }
        /*Cancela un Booking*/
        public function cancelBooking($id)
        {
            $booking = Booking::find($id);
            if ($booking) {
                $booking->estado = 'Cancelada';
                $booking->save();
            }
            return $booking;
        }
        /*Acepta un Booking*/
        public function acceptBooking($id)
        {
            $booking = Booking::find($id);
            if ($booking) {
                $booking->estado = 'Aceptado';
                $booking->save();
            }
            return $booking;
        }

        /*Obtiene bookings por conductor*/
        public function getBookingsByDriver($idUsuario)
        {
            $today = now()->toDateString();

            $results = DB::table('reserva as res')
                ->select(
                    'res.idReserva',
                    'res.idUsuario',
                    'res.estado',
                    'u.nombre',
                    'u.apellido',
                    'u.cedula',
                    'u.correo',
                    'r.nombre as ride_nombre',
                    'r.fecha',
                    'r.hora'
                )
                ->join('usuarios as u', 'res.idUsuario', '=', 'u.idUsuario')
                ->join('ride as r', 'res.idRide', '=', 'r.idRide')
                ->join('vehiculos as v', 'r.idVehiculo', '=', 'v.idVehiculo')
                ->where('v.idUsuario', $idUsuario)
                ->where('res.estado', 'Pendiente')
                ->whereRaw('LOWER(r.estado) <> ?', ['realizado'])
                ->whereDate('r.fecha', '>=', $today)
                ->orderByDesc('res.idReserva')
                ->get();

            return $results->map(function($item){
                return (array) $item;
            })->all();
        }
        public function getCompletedTripsByUser($idUsuario)
        {
            return DB::table('reserva as res')
                ->select(
                    'res.idReserva',
                    'res.idUsuario',
                    'res.estado as reserva_estado',
                    'r.idRide',
                    'r.nombre as ride_nombre',
                    'r.salida',
                    'r.llegada',
                    'r.fecha',
                    'r.hora',
                    'r.espacios',
                    'r.costo_espacio',
                    'r.estado as ride_estado'
                )
                ->join('ride as r', 'res.idRide', '=', 'r.idRide')
                ->where('res.idUsuario', $idUsuario)
                ->whereRaw('LOWER(r.estado) = ?', ['realizado'])
                ->orderByDesc('r.fecha')
                ->get()
                ->map(function($item){
                    return (array) $item;
                })->all();
        }

        
    }
?>