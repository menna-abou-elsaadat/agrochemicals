<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
           'product_id' => $this->category_product_id,
           'name' => $this->product->name,
           'price' => $this->price,
           'count' => $this->count,
        ];
    }
}
