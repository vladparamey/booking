<?php

namespace App\Repositories;

use App\Contracts\TableRepositoryInterface;
use App\Models\Booking;
use App\Models\Table;

class EloquentTableRepository implements TableRepositoryInterface
{
    public function findAvailableTable(int $guests, string $date, string $time): ?Table
    {
        $tables = Table::where('seating_capacity', '>=', $guests)
            ->orderBy('seating_capacity', 'asc')
            ->get();

        foreach ($tables as $table) {
            $bookingCount = Booking::where('table_id', $table->id)
                ->where('booking_date', $date)
                ->count();

            if ($bookingCount === 0) {
                return $table;
            }
        }

        return null;
    }
}
