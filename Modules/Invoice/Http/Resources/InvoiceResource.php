<?php

namespace Modules\Invoice\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'amount' => $this->amount,
            'status' => $this->status,
            'invoice_date' => $this->invoice_date,
            'due_date' => $this->due_date,
            'payment_link'=>route('stripe.getpost',$this->id)
        ];
    }
}
