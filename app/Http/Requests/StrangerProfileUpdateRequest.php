<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StrangerProfileUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:255'],
            'father_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],  
            'role' => ['string','max:255'],
        ];
    }
}
