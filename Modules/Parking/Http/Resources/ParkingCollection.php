<?php

namespace Modules\Parking\Http\Resources;

use Illuminate\Http\Request;
use Modules\Parking\Http\Resources\ParkingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParkingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'count' => $this->count(),
            'total' => $this->total(),
            'prev'  => $this->previousPageUrl(),
            'next'  => $this->nextPageUrl(),
            'data' => $this->collection
        ];
    }
}
