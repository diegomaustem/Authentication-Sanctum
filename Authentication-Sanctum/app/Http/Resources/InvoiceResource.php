<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray($request)
    {
        return[
            'user_id' => $this->user_id,
            'type' => $this->type,
            'paid' => $this->paid,
            'value' => $this->value,
            'payment_date' => $this->payment_date
         ];
    }
}
