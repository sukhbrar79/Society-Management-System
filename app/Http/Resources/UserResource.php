<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
          // Get the base URL from the environment
        $appUrl = env('APP_URL');

        // Generate the full URL for the avatar
        $avatarUrl = $this->avatar 
            ? $appUrl . Storage::disk('public')->url($this->avatar)
            : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'mobile' => $this->mobile,
            'avatar' => $avatarUrl,
            'flat' => $this->flat->name ?? '-',
            'block' => $this->block->name ?? '-',
        ];
    }
}
