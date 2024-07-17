<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    use HttpResponses;

    public function getInvoices()
    {
        return InvoiceResource::collection(Invoice::with('user')->get());
    }

    public function getInvoice(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    public function createInvoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required',
            'paid' => 'required|numeric|between:0,1',
            'payment_date' => 'nullable',
            'value' => 'required|numeric|between:1,9999.99'
        ]);

        if($validator->fails()) {
            return $this->error('Data Invalid', 422, $validator->errors());
        }

        $created = Invoice::create($validator->validated());

        if($created) {
            return $this->response('Invoice created', 200, new InvoiceResource($created->load('user')));
        }
        return $this->error('Invoice not created', 400);
    }
}
