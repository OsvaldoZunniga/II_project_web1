<?php

    namespace App\Services;
    use App\Models\Booking;
    use App\Models\Ride;



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
        public function cancelBooking($id)
        {
            $booking = Booking::find($id);
            if ($booking) {
                $booking->estado = 'Cancelada';
                $booking->save();
            }
            return $booking;
        }
    }
?>