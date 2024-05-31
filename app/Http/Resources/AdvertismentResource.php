<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertismentResource extends JsonResource
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
            'text' => $this->text,
            'image' => $this->file?url('uploads'.DIRECTORY_SEPARATOR.$this->file->uuid.DIRECTORY_SEPARATOR.$this->file->name):null
        ];
    }
}
