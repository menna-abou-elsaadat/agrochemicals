<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFavouriteResource extends JsonResource
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
            'user' => $this->user->name,
            'product_id' => $this->category_product_id,
            'category_id' => $this->categoryProduct->category->id,
            'product_name' => $this->categoryProduct->name,
            'category_name' => $this->categoryProduct->category->name,
            'price' => $this->categoryProduct->price,
            'discount' => $this->categoryProduct->discount,
            'img_url' => $this->categoryProduct->file?url('uploads'.DIRECTORY_SEPARATOR.$this->categoryProduct->file->uuid.DIRECTORY_SEPARATOR.$this->categoryProduct->file->name):null,
            'stock' => $this->categoryProduct->stock,
            'region' => $this->categoryProduct->region
        ];
    }
}
