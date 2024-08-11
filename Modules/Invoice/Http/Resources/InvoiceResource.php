<?php

namespace Modules\Invoice\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class InvoiceResource extends JsonResource
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
            'invoice_number' => $this->invoice_number,
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->amount,
            'status' => $this->status,
            'invoice_date' => $this->formatDate($this->invoice_date),
            'due_date' => $this->formatDate($this->due_date),
            'payment_link'=>route('stripe.getpost',$this->id)
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
