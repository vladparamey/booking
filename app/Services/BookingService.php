<?php

namespace App\Services;

use App\Contracts\BookingRepositoryInterface;
use App\Contracts\TableRepositoryInterface;
use App\Models\Booking;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookingService
{
    /**
     * @var BookingRepositoryInterface $bookingRepository
     */
    protected BookingRepositoryInterface $bookingRepository;
    /**
     * @var TableRepositoryInterface $tableRepository
     */
    protected TableRepositoryInterface $tableRepository;
    /**
     * @var int $timeForCancelling
     */
    protected int $timeForCancelling;

    /**
     * @param BookingRepositoryInterface $bookingRepository
     * @param TableRepositoryInterface $tableRepository
     */
    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        TableRepositoryInterface   $tableRepository
    )
    {
        $this->bookingRepository = $bookingRepository;
        $this->tableRepository = $tableRepository;
        // in hours
        $this->timeForCancelling = 2;
    }

    /**
     * @param int $userId
     * @param string $date
     * @param string $time
     * @param int $guests
     * @return Booking
     * @throws Exception
     */
    public function createBooking(int $userId, string $date, string $time, int $guests): Booking
    {
        $table = $this->tableRepository->findAvailableTable($guests, $date, $time);

        if (! $table) {
            throw new Exception('There is no available table for the requested number of guests.');
        }

        return DB::transaction(function () use ($userId, $date, $time, $guests, $table) {
            return $this->bookingRepository->create([
                'user_id' => $userId,
                'table_id' => $table->id,
                'booking_date' => $date,
                'booking_time' => $time,
                'guests' => $guests,
            ]);
        });
    }

    /**
     * @param int $userId
     * @param Booking $booking
     * @return bool
     * @throws Exception
     */
    public function cancelBooking(int $userId, Booking $booking): bool
    {
        if ($booking->user_id !== $userId) {
            throw new Exception('There is no current booking.');
        }

        $bookingDateTime = Carbon::createFromFormat(
            'Y-m-d H:i:s',
            $booking->booking_date . ' ' . $booking->booking_time
        );

        if (Carbon::now()->diffInHours($bookingDateTime, false) < $this->timeForCancelling) {
            throw new Exception('Cancellation is possible no less than 2 hours before the booking time.');
        }

        return $this->bookingRepository->delete($booking);
    }

    /**
     * @param string $date
     * @return Collection
     */
    public function getBookingsByDate(string $date): Collection
    {
        return $this->bookingRepository->getBookingsByDate($date);
    }
}
