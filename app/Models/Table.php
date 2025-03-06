<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'seating_capacity'];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
