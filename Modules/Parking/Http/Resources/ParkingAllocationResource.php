<?php

namespace Modules\Parking\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Parking\Http\Resources\ParkingResource;

class ParkingAllocationResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parking' => new ParkingResource($this->parking),
            'allocation_date' => $this->allocation_date,
            'status' => $this->status,
            'expiration_date' => $this->expiration_date,
            'block' => $this->block?->name,
            'flat' => $this->flat?->name,
        ];
    }
}
