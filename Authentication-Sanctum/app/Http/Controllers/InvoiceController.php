<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getInvoices()
    {
        return InvoiceResource::collection(Invoice::with('user')->get());
    }

    public function getInvoice(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }
}
