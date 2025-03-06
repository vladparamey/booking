<?php

namespace App\Contracts;

use App\Models\Table;

interface TableRepositoryInterface
{
    public function findAvailableTable(int $guests, string $date, string $time): ?Table;
}
