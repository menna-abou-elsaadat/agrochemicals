<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProductResource extends JsonResource
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
            'category'=>$this->category->name,
            'id'=>$this->id,
            'name' => $this->name,
            'image' => $this->file?url('uploads'.DIRECTORY_SEPARATOR.$this->file->uuid.DIRECTORY_SEPARATOR.$this->file->name):null,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'stock'=>$this->stock,
            'category_id'=>$this->category->id,

        ];
    }
}
