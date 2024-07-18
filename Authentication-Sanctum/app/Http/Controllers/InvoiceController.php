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

    public function getInvoices(Request $request)
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

    public function updateInvoice(Request $request, Invoice $invoice)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required|in:' . implode(',', ['Boleto','Pix','Cartao']),
            'paid' => 'required|numeric|between:0,1',
            'payment_date' => 'nullable|date_format:Y-m-d H:i:s',
            'value' => 'required|numeric'
        ]);

        if($validator->fails()) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = $invoice->update([
            'user_id' => $validated['user_id'],
            'type' => $validated['type'],
            'paid' => $validated['paid'],
            'payment_date' => $validated['paid'] ? $validated['payment_date'] : null,
            'value' => $validated['value']
        ]);

        if($updated) {
            return $this->response('Invoice updated', 200, new InvoiceResource($invoice->load('user')));
        }
        return $this->error('Invoice not updated', 400);
    }

    public function deleteInvoice(Invoice $invoice)
    {
        $deleted = $invoice->delete();

        if($deleted) {
            return $this->response('Invoice deleted', 200);
        }
        return $this->error('Invoice not deleted', 400);

    }
}
