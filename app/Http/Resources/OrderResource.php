<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderProductResource;

class OrderResource extends JsonResource
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
           'user_id' => $this->user_id,
           'user_name' => $this->user->name,
           'address' => $this->shipping_address,
           'city' => $this->shipping_governorate,
           'phone' => $this->phone,
           'total_price' => $this->total_price,
           'shipping_fees' => $this->shipping_fees,
           'discount' => $this->discount,
           'final_price' => $this->final_price,
           'payment_type' => $this->payment_type,
           'payment_status' => $this->payment_status,
           'order_status' => $this->order_status,
           'products'=> OrderProductResource::collection($this->products)
        ];
    }
}
