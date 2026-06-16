<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'booking_id' => [
                'required',
                'exists:bookings,id'
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0'
            ],

            'payment_date' => [
                'required',
                'date'
            ],

            'proof_image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240'
            ],

            'status' => [
                'required',
                'in:pending,approved,rejected'
            ],

        ];
    }
}
