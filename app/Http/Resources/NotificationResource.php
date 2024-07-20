<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subject' => $this->data['subject']??'-',
            'message' => $this->data['message']??'-',
            'link' => $this->data['link']??'-',
            'created_at' => $this->created_at->toDateTimeString(),
            'read_at' => $this->read_at ? $this->read_at->toDateTimeString() : null,
        ];
    }
}

