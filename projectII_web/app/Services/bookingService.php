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
    }
?>