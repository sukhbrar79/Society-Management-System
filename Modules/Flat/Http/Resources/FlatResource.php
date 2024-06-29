<?php

namespace Modules\Flat\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FlatResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->id){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'floor'=>$this->floor,
            'rooms'=>$this->rooms,
            'block'=>$this->block->name?$this->block->name:'-',
        ];
    }
    }
}