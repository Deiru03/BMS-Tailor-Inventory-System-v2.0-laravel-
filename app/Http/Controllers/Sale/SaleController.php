<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\InvoiceSale;
use App\Models\CustomersInfo;
use App\Models\ReturnSales;
use App\Models\SalesReport;
use Illuminate\Http\Request;

class SaleController extends Controller
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
        try {
            $request->validate([
                'customer_id' => 'required|exists:customers_infos,id',
                'products' => 'required|array',
                'products.*.product_id' => 'required|exists:products,id',
                'products.*.quantity' => 'required|integer|min:1',
                'amount_paid' => 'required|numeric|min:0',
            ]);

            // Generate custom ID in format: SALE-YYYYMMDD-XXXX
            $date = now()->format('Ymd');
            $lastSale = Sale::whereDate('created_at', now())->latest('custom_id')->first();

            // Extract the sequence number from the last sale's custom_id
            $sequence = $lastSale ? (int)substr($lastSale->custom_id, -4) + 1 : 1;

            // Generate the new custom_id
            $custom_id = 'SALE-' . $date . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);

            // Create the sale
            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'custom_id' => $custom_id,
                'total_amount' => 0, // Will calculate later
                'payment_status' => 'unpaid',
                'amount_paid' => $request->amount_paid,
                'change_due' => 0, // Will calculate later
                'balance' => 0,    // Will calculate later
            ]);

            $totalAmount = 0;

            // Add sale items and deduct stock
            foreach ($request->products as $productData) {
                $product = Product::findOrFail($productData['product_id']);

                // Check if stock is sufficient
                if ($product->stock_quantity < $productData['quantity']) {
                    return back()->withErrors(['error' => "Insufficient stock for product: {$product->name}"]);
                }

                // Deduct stock
                $product->stock_quantity -= $productData['quantity'];
                $product->save();

                // Add sale item
                $subtotal = $product->unit_price * $productData['quantity'];
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $productData['quantity'],
                    'unit_price' => $product->unit_price,
                    'subtotal' => $subtotal,
                ]);

                $totalAmount += $subtotal;
            }

            // Update total amount, change due, and balance
            $sale->update([
                'total_amount' => $totalAmount,
                'change_due' => max(0, $request->amount_paid - $totalAmount),
                'balance' => max(0, $totalAmount - $request->amount_paid),
                'payment_status' => $request->amount_paid >= $totalAmount ? 'paid' : ($request->amount_paid > 0 ? 'partial' : 'unpaid'),
            ]);

            // Create invoice sale
            SalesReport::create([
                'sale_id' => $sale->custom_id,
                'customer_name' => CustomersInfo::find($request->customer_id)->name,
                'total_amount' => $totalAmount,
                'payment_status' => $sale->payment_status,
                'sale_date' => now(),
            ]);

            return redirect()->route('invoice-action.show', $sale->id)->with('success', 'Sale confirmed successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('ViewSale')->with('error', 'Error confirming sale: ' . $th->getMessage());
        }
    }

    public function payRemainingBalance(Request $request, Sale $sale)
    {
        try {
            $request->validate([
                'amount' => 'required|numeric|min:0.01|max:' . $sale->balance,
            ]);
        
            // Update the sale's payment details
            $sale->amount_paid += $request->amount;
            $sale->balance -= $request->amount;
        
            // Update payment status if fully paid
            if ($sale->balance <= 0) {
                $sale->payment_status = 'paid';
                $sale->balance = 0; // Ensure balance is exactly 0
            }
        
            $sale->save();
        
            // Redirect to the invoice details page
            $invoice = $sale->invoiceSales; // Assuming the relationship is defined in the Sale model
            if ($invoice) {
                return redirect()->route('invoice-action.showDetail', $invoice->id)
                                 ->with('success', 'Payment successfully recorded. Redirecting to the invoice.');
            }
        
            return redirect()->route('ViewSale')->with('error', 'Invoice not found for this sale.');
        } catch (\Throwable $th) {
            return redirect()->route('ViewSale')->with('error', 'Error processing payment: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        try {
            $Sale = Sale::findOrFail($id);
            $SaleCustomId = $Sale->custom_id;

            $Sale->delete();
            return redirect()->route('ViewSale')->with('success', 'Sale deleted successfully.' . $SaleCustomId);
        } catch (\Throwable $th) {
            return redirect()->route('ViewSale')->with('error', 'Error deleting sale: ' . $th->getMessage());
        }
       
    }
}
