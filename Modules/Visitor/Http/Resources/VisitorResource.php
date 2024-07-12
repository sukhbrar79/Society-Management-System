<?php

namespace Modules\Visitor\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitorResource extends JsonResource
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
            'name' => $this->name,
            'contact_number' => $this->contact_number,
            'purpose' => $this->purpose,
            'vehicle_number' => $this->vehicle_number,
            'block_id' => $this->block->name,
            'flat_id' => $this->flat->name,
            'check_in_time' => $this->check_in_time,
            'check_out_time' => $this->check_out_time,
            'check_in_date' => $this->check_in_date,
            'check_out_date' => $this->check_out_date,
        ];
    }
}
