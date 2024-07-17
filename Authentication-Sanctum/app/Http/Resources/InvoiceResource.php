<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray($request)
    {
        $paid = $this->paid;
        return[
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email
            ],
            'type' => $this->type,
            'value' => 'R$ ' . number_format($this->value, 2, ',', '.'),
            'paid' => $paid ? 'Pago' : 'Não pago',
            'paymentDate' => $paid ? Carbon::parse($this->payment_date)->format('d/m/Y H:i:s') : Null,
            'paymentSince' => $paid ? Carbon::parse($this->payment_date)->diffForHumans() : Null,
        ];
    }
}
