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
use App\Models\SalesReport;
use App\Models\ExpenseReport;
use App\Models\InvoiceReport;


class ViewController extends Controller
{
    public function dashboard(request $request): View{

        // Get the filter from the request or default to 'today'
        $filter = $request->get('filter', 'today');

        // Determine the date range based on the filter
        switch ($filter) {
            case 'week':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            case 'today':
            default:
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                break;
        }
        // Fetch key metrics
        // $totalSales = Sale::sum('total_amount');
        $totalSales = Sale::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');
        $totalCustomers = CustomersInfo::count();
        $totalProducts = ProductInfo::count();
        $pendingPayments = Sale::where('payment_status', '!=', 'paid')->sum('balance');

        // Fetch recent sales
        $recentSales = Sale::with('customer')->latest()->take(5)->get();

        // Fetch product stocks
        // Get 5 products with the lowest stock quantities (ordered from lowest to highest)
        $productStocks = ProductInfo::select('name', 'stock_quantity', 'unit_price')
            ->orderBy('stock_quantity', 'asc')
            ->take(5)
            ->get();

        // Prepare data for sales chart
        $salesData = Sale::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $salesDates = $salesData->pluck('date');
        $salesAmounts = $salesData->pluck('total');

        return view('dashboard', compact(
            'totalSales',
            'totalCustomers',
            'totalProducts',
            'pendingPayments',
            'recentSales',
            'productStocks',
            'salesDates',
            'salesAmounts',
            'filter'
        ));
    }

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
        $sales = $query->orderBy('created_at', 'desc')->paginate(10);

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
    
    public function salesReport(Request $request)
    {
        // Start with a base query
        $query = SalesReport::query();

        // Apply filters
        if ($request->filled('date_from')) {
            $query->whereDate('sale_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('sale_date', '<=', $request->date_to);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Get the filtered results with pagination
        $sales = $query->orderBy('sale_date', 'desc')->paginate(10);

        return view('report.sales-reports', compact('sales'));
    }

    public function expensesReport(Request $request)
    {
        // Fetch unique supplier types for the filter dropdown
        $supplierTypes = MaterialInfo::select('supplier_type_name')->distinct()->get();

        // Start with a base query
        $query = MaterialInfo::with('supplier'); // Eager-load the supplier relationship

        // Apply filters
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('supplier_type')) {
            $query->where('supplier_type_name', $request->supplier_type);
        }

        // Get the filtered results with pagination
        $materials = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('report.expenses-reports', compact('materials', 'supplierTypes'));
    }

    public function invoiceReport(Request $request)
    {
        // Start with a base query
        $query = InvoiceReport::query();

        // Apply filters
        if ($request->filled('date_from')) {
            $query->whereDate('invoice_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('invoice_date', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get the filtered results with pagination
        $invoices = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('report.invoice-reports', compact('invoices'));
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
