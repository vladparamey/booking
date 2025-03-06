<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        $tables = [
            ['name' => 'T1', 'seating_capacity' => 2],
            ['name' => 'T2', 'seating_capacity' => 1],
            ['name' => 'T3', 'seating_capacity' => 4],
            ['name' => 'T4', 'seating_capacity' => 4],
            ['name' => 'T5', 'seating_capacity' => 4],
            ['name' => 'T6', 'seating_capacity' => 6],
            ['name' => 'T7', 'seating_capacity' => 6],
            ['name' => 'T8', 'seating_capacity' => 2],
            ['name' => 'T9', 'seating_capacity' => 2],
            ['name' => 'T10', 'seating_capacity' => 2],
        ];

        foreach ($tables as $table) {
            Table::create($table);
        }
    }
}
