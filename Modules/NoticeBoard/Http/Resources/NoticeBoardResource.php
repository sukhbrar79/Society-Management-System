<?php

namespace Modules\NoticeBoard\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeBoardResource extends JsonResource
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
            'description' => $this->description,
            'status' => $this->status,
            'expiry_date' => $this->expiry_date ? $this->expiry_date->toDateString() : null,
            'created_at' => $this->created_at ? $this->created_at->toDateString() : null,
        ];
    }
}
