<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DiesesResource;

class SingleCategoryProductResource extends JsonResource
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
            'category_id'=>$this->category->id,
            'category'=>$this->category->name,
            'id'=>$this->id,
            'name' => $this->name,
            'secondary_name' => $this->secondary_name,
            'description' => $this->description,
            'cost' => $this->cost,
            'special' => $this->special,
            'active_material' => $this->active_material,
            'properties' => $this->properties,
            'recommended_doses' => $this->recommended_doses,
            'hse_precuations' => $this->hse_precuations,
            'other_data' => $this->other_data,
            'origin_country' => $this->origin_country,
            'image' => $this->file?url('uploads'.DIRECTORY_SEPARATOR.$this->file->uuid.DIRECTORY_SEPARATOR.$this->file->name):null,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'stock'=>$this->stock,
            'dieses' => DiesesResource::collection($this->dieses)
        ];
    }
}
