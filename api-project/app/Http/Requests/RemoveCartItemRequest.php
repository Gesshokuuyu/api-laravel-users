<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RemoveCartItemRequest extends FormRequest
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
            'cart_item' => [
                            'required',
                            'integer',
                            Rule::exists('shopping_cart_items', 'item_id')->where('cart_id', $this->user()->shoppingCart->id)
                        ]
        ];
    }

    public function messages(): array
    {
        return [
            'cart_item.required' => 'O item do carrinho é obrigatório.',
            'cart_item.exists'   => 'Item não disponível no carrinho.',
            'cart_item.integer'  => 'Tipo do campo inválido.'
        ];
}
}
