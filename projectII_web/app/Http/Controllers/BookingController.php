<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Services\BookingService;
    use App\Services\AuthService;

    class BookingController extends Controller
    {
        protected $bookingService;

        public function __construct(BookingService $bookingService)
        {
            $this->bookingService = $bookingService;
        }

        /**
         * Crear una nueva reserva
         */
        public function store(Request $request)
        {
            $authService = app(AuthService::class);
            $user = $authService->getAuthenticatedUser();

            $result = $this->bookingService->createBooking(
                $user['idUsuario'],
                $request->input('ride_id'),
                $request->all()
            );

            if ($result['success']) {
                return redirect()->back()
                    ->with('type', 'success');
            }

            return redirect()->back()
                ->with('msg', $result['message'])
                ->with('type', 'error');
        }
        /*Obtiene Bookings pendientes por pasajero*/
        public function getReservations(Request $request)
        {
            $authService = app(AuthService::class);
            $user = $authService->getAuthenticatedUser();

            $bookings = $this->bookingService->getBookingsByUser($user['idUsuario'])->load('ride');

            return view('dashboard.main', [
                'content' => 'passenger.my-reservations',
                'user' => $user,
                'bookings' => $bookings
            ]);
        }
        /*Obtiene Bookings por conductor*/
        public function getReservationsDriver(Request $request)
        {
            $authService = app(AuthService::class);
            $user = $authService->getAuthenticatedUser();
            
            $bookings = $this->bookingService->getBookingsByDriver($user['idUsuario']);
            
            return view('dashboard.main', [
                'content' => 'driver.reservations.reservations',
                'user' => $user,
                'bookings' => $bookings
            ]);
        }
        /*Cambia el estado de un booking a Cancelado*/
        public function cancel($id)
        {
            $this->bookingService->cancelBooking($id);
    
        return redirect()->back()
                ->with('msg', 'booking_cancelled')
                ->with('type', 'success');
        }
        /*Cambia el estado de un booking a Aceptado*/
        public function accept($id)
        {
            $this->bookingService->acceptBooking($id);
            return redirect()->back()
                ->with('msg', 'booking_cancelled')
                ->with('type', 'success');
        }
        /*Obtiene los viajes realizados por el pasajero*/
        public function myTrips()
        {
            $authService = app(AuthService::class);
            $user = $authService->getAuthenticatedUser();
            $trips = $this->bookingService->getCompletedTripsByUser($user['idUsuario']);
            return view('dashboard.main', [
                'content' => 'passenger.my-trips',
                'user' => $user,
                'trips' => $trips
            ]);
        }

        
    }
    ?>