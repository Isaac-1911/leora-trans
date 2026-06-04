<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
        'name' => ['required','max:255'],
        'brand' => ['required','max:255'],
        'year' => ['required'],
        'plate_number' => ['required'],
        'price_per_day' => ['required','numeric'],
        'status' => ['required'],
        'thumbnail' => ['nullable','image'],
        'description' => ['nullable']
    ];


    }
}
