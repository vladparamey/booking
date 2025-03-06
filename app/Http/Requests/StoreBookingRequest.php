<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'booking_date' => 'required|date_format:Y-m-d',
            'booking_time' => 'required|date_format:H:i:s',
            'number_of_guests' => 'required|integer|min:1',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->filled('booking_date') && $this->filled('booking_time')) {
                $bookingDateTime = Carbon::createFromFormat(
                    'Y-m-d H:i:s',
                    $this->input('booking_date') . ' ' . $this->input('booking_time')
                );

                if ($bookingDateTime <= Carbon::now()) {
                    $validator->errors()->add(
                        'booking_date',
                        'The booking date and time must be later than the current moment.'
                    );
                }
            }
        });
    }
}
