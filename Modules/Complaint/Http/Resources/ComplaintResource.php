<?php

namespace Modules\Complaint\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ComplaintResource extends ResourceCollection
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
            'email' => $this->email,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'username'=>$this->username,
            'email'=>$this->email,
        ];
    }
}
