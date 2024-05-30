<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiesesResource extends JsonResource
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
           'crop' => $this->crop,
           'dieses' => $this->dieses,
           'hse_precuations' => $this->hse_precuations,
           'phi' => $this->phi
        ];
    }
}
