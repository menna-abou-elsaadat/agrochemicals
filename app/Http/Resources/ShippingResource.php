<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
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
            'governorate' => $this->governorate,
            'shipping_cost' => $this->shipping_cost,
            'min_free_shipping_cost' => $this->min_free_shipping_cost,
            
        ];
    }
}
