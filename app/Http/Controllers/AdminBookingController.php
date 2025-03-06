<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\BookingService;
use Symfony\Component\HttpFoundation\Response;

class AdminBookingController extends Controller
{
    /**
     * @var BookingService $bookingService
     */
    protected BookingService $bookingService;

    /**
     * @param BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'booking_date' => ['required', 'date_format:Y-m-d'],
        ]);

        $bookingDate = $request->input('booking_date');

        $bookings = $this->bookingService->getBookingsByDate($bookingDate);

        return BookingResource::collection($bookings)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
