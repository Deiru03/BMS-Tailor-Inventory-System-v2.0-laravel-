<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\CustomersInfo;
use App\Models\SupplierInfo;
use App\Models\SupplierType;
use App\Models\Material as MaterialInfo;
use App\Models\Product as ProductInfo;
use App\Models\CategoryProduct;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\InvoiceSale;


class ViewController extends Controller
{
    //------------------------- Sidebar Buttons and Routes ------------------------- //
    public function customer(){

        $customers = CustomersInfo::all();

        return view('customers', compact('customers'));
    }

    public function supplier()
    {
        // Fetch all suppliers with their types
        $suppliers = SupplierInfo::with('types')->get();
    
        // Fetch all supplier types for the create form
        $supplierTypes = SupplierType::all();
    
        // Pass both suppliers and supplier types to the view
        return view('suppliers', compact('suppliers', 'supplierTypes'));
    }

    public function material(){
        
        $materials = MaterialInfo::all();

        return view('materials', compact('materials'));
    }

    public function product(){

        // Call the updateLowStockStatus method before fetching products
        ProductInfo::updateLowStockStatus();

        $products = ProductInfo::all();
        $suppliers = SupplierInfo::all();
        $categories = CategoryProduct::all();
        
        return view('products', compact('products', 'suppliers', 'categories'));
    }

    public function sale(request $request): View{
        // Start with a base query
        $query = Sale::with(['customer', 'invoiceSales']);

        // Apply filters
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('invoice_status')) {
            if ($request->invoice_status === 'has_invoice') {
                $query->has('invoiceSales');
            } elseif ($request->invoice_status === 'no_invoice') {
                $query->doesntHave('invoiceSales');
            }
        }

        // Get the filtered results with pagination
        $sales = $query->orderBy('created_at', 'desc')->paginate(15);

        // Fetch additional data for the view
        $customers = CustomersInfo::all();
        $products = ProductInfo::all();
        $suppliers = SupplierInfo::all();

        return view('sales', [
            'sales' => $sales,
            'customers' => $customers,
            'products' => $products,
            'suppliers' => $suppliers
        ]);
    }

    // public function __construct()
    // {
    //     $products = ProductInfo::all();
    //     $suppliers = SupplierInfo::all();
    //     $categories = CategoryProduct::all();
        
    //     // Share data with all views
    //     view()->share('products', $products);
    //     view()->share('suppliers', $suppliers);
    //     view()->share('categories', $categories);
    // }
}
