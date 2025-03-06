<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'booking_date' => $this->booking_date,
            'booking_time' => $this->booking_time,
            'guests' => $this->guests,
            'table' => [
                'id' => $this->table->id,
                'name' => $this->table->name,
            ],
            'user' => [
                'id' => $this->user->id,
                'email' => $this->user->email,
            ],
        ];
    }
}
