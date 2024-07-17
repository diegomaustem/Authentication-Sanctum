<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getInvoices()
    {
        return InvoiceResource::collection(Invoice::all());
    }

    public function getInvoice(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }
}
