<?php

namespace Modules\Guideline\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class GuidelineResource extends JsonResource
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
        ];
    }

    /**
     * Format the given date.
     *
     * @param mixed $date
     * @return string|null
     */
    protected function formatDate($date): ?string
    {
        return $date ? Carbon::parse($date)->format('Y-m-d') : null;
    }
}
