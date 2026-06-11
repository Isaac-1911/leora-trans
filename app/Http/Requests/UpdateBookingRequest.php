<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_id' => ['required'],
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'notes' => 'nullable',
            'payment_status' => [
                'required',
                'in:pending,paid,rejected'
            ],

            'booking_status' => [
                'required',
                'in:waiting_payment,confirmed,ongoing,completed,cancelled'
            ],
        ];
    }
}
