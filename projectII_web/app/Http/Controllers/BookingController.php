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
                return redirect()->route('dashboard')
                    ->with('msg', 'booking_created')
                    ->with('type', 'success');
            }

            return redirect()->back()
                ->with('msg', $result['message'])
                ->with('type', 'error');
        }
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
        public function cancel($id)
        {
            $booking = $this->bookingService->cancelBooking($id);

        return redirect()->route('bookings.reservations')
                ->with('msg', 'booking_cancelled')
                ->with('type', 'success');
        }
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
    }
?>