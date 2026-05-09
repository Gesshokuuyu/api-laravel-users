<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingCartResource extends JsonResource
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
            'user' => $this->user_id,

            'total_price' => $this->whenLoaded(
                'items',
                fn() => $this->items->sum(
                    fn($item) => $item->pivot->price
                )
            ),
            'items' => CartItemResource::collection(
                $this->whenLoaded('items')
            )
        ];
    }
}
