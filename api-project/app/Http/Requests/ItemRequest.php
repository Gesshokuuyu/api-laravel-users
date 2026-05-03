<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name'          => ['string', 'required', 'min:15', 'max:100'],
            'code'          => ['string', 'required', 'min:5', 'max:35', 'unique:items,code'],
            'description'   => ['required','string'],
            'price'         => ['required', 'numeric', 'min:0'],
            'stock'         => ['required', 'numeric', 'min:0']
        ];
    }
}
