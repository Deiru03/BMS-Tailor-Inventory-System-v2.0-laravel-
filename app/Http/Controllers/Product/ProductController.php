<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\SupplierInfo;


class ProductController extends Controller
{
    public function updateLowStockStatus()
    {
        // Update products with stock_quantity between 1 and 10 to "low_stock"
        Product::where('stock_quantity', '<=', 10)
            ->where('stock_quantity', '>', 0)
            ->where('status', '!=', 'low_stock')
            ->update(['status' => 'low_stock']);

        // Update products with stock_quantity of 0 to "out_of_stock"
        Product::where('stock_quantity', 0)
            ->where('status', '!=', 'out_of_stock')
            ->update(['status' => 'out_of_stock']);

        // Optionally, update products with stock_quantity greater than 10 to "in_stock"
        Product::where('stock_quantity', '>', 10)
            ->where('status', '!=', 'in_stock')
            ->update(['status' => 'in_stock']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all products
        // For now Leave it Blank
        // Index is at the ViewController
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
        // dd($request->all());  
        try {
            $request->validate([
                'product_code' => 'required|string|max:50|unique:products,product_code',
                'name' => 'required|string|max:255',
                // 'product_type' => 'nullable|string|max:255', // This might be incorrect
                'product_type' => 'nullable|string|max:255',
                'supplier_id' => 'nullable|exists:supplier_infos,id',
                'stock_quantity' => 'required|numeric|min:0',
                'unit_price' => 'required|numeric|min:0',
                'status' => 'required|in:in_stock,low_stock,out_of_stock,discontinued',
                'is_active' => 'required|boolean',
            ]);

            // Create the product
            Product::create([
                'product_code' => $request->input('product_code'),
                'name' => $request->input('name'),
                'product_type' => $request->input('product_type'), // Save the string directly
                'supplier_id' => $request->input('supplier_id'),
                'description' => $request->input('description'),
                'stock_quantity' => $request->input('stock_quantity'),
                'unit' => $request->input('unit'),
                'unit_price' => $request->input('unit_price'),
                'cost_price' => $request->input('cost_price'),
                'color' => $request->input('color'),
                'size' => $request->input('size'),
                'material' => $request->input('material'),
                'brand' => $request->input('brand'),
                'pattern' => $request->input('pattern'),
                'status' => $request->input('status'),
                'is_active' => $request->input('is_active'),
            ]);

            // $this->updateLowStockStatus();
            
            return redirect()->route('ViewProduct')->with('success', 'Product created successfully.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to create product: ' . $th->getMessage());
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
        $product = Product::findOrFail($id);
        $categories = CategoryProduct::all();
        $suppliers = SupplierInfo::all();

        return view('components.product-modals.product-edit', compact('prduct', 'categories', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request ->  validate([
            'product_code' => 'required|string|max:50|unique:products,product_code,' . $id,
            'name' => 'required|string|max:255',
            // 'category_id' => 'nullable|exists:category_products,id',
            'product_type' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|exists:supplier_infos,id',
            'stock_quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'status' => 'required|in:in_stock,low_stock,out_of_stock,discontinued',
            'is_active' => 'required|boolean',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        // $this->updateLowStockStatus();

        return redirect()->route('ViewProduct')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      try {
        $product = Product::findOrFail($id);

        $product->delete();

        // $this->updateLowStockStatus();

        return redirect()->route('ViewProduct')->with('success', 'Product deleted successfully.');
      } catch (\Throwable $e) {
        return redirect()->back()->with('error', 'Product not found.' . $e->getMessage());
      } 
    }
}
