<?php

namespace App\Contracts;

use App\Models\Booking;
use Illuminate\Support\Collection;

interface BookingRepositoryInterface
{
    public function create(array $data): Booking;

    public function delete(Booking $booking): bool;

    public function getBookingsByDate(string $date): Collection;
}
