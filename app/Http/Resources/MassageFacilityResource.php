<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MassageFacilityResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->location,
            'description' => $this->description,
            'imageURL' => asset($this->imageUrl),
            'rating' => $this->averageRating,
            'reviewCount' => $this->reviewCount,
        ];
    }
}
