<?php

namespace App\Repositories;

use App\Contracts\BookingRepositoryInterface;
use App\Models\Booking;
use Illuminate\Support\Collection;

class EloquentBookingRepository implements BookingRepositoryInterface
{
    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function delete(Booking $booking): bool
    {
        return $booking->delete();
    }

    public function getBookingsByDate(string $date): Collection
    {
        return Booking::where('booking_date', $date)
            ->orderBy('booking_time', 'asc')
            ->get();
    }
}
