<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\InvoiceSale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\ReturnSales;
use App\Models\CustomersInfo;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($saleId)
    {
        $sale = Sale::with('customer', 'saleItems.product')->findOrFail($saleId);
    
        // Check if an invoice already exists for this sale
        $existingInvoice = InvoiceSale::where('sale_id', $sale->id)->first();
        if ($existingInvoice) {
            return redirect()->route('invoice-action.show', $existingInvoice->id)
                ->with('success', 'Invoice already exists.');
        }
    
        // Generate a new invoice
        $invoice = InvoiceSale::create([
            'sale_id' => $sale->id,
            'invoice_number' => 'INV-' . str_pad($sale->id, 6, '0', STR_PAD_LEFT),
            'total_amount' => $sale->total_amount,
            'issued_at' => now(),
        ]);
    
        return view('components.sale-modals.invoice.invoice-detailed', compact('invoice'))->with('invoice_id', $invoice->id)
            ->with('success', 'Invoice generated successfully.');
    }

    /**
     * Show the form for displaying the specified resource.
     */
    public function showDetail($invoiceId)
    {
        // dd($invoiceId);
    
        $invoice = InvoiceSale::with('sale.customer', 'sale.saleItems.product')->findOrFail($invoiceId);
    
        return view('components.sale-modals.invoice.invoice-detailed', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
