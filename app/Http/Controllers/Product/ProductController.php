<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\SupplierInfo;


class ProductController extends Controller
{
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
        try {
            $request->validate([
                'product_code' => 'required|string|max:50|unique:products,product_code',
                'name' => 'required|string|max:255',
                'category_id' => 'nullable|exists:category_products,id',
                'supplier_id' => 'nullable|exists:supplier_infos,id',
                'stock_quantity' => 'required|numeric|min:0',
                'unit_price' => 'required|numeric|min:0',
                'status' => 'required|in:in_stock,low_stock,out_of_stock,discontinued',
                'is_active' => 'required|boolean',
            ]);
        
            Product::create($request->all());
        
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
            'category_id' => 'nullable|exists:category_products,id',
            'supplier_id' => 'nullable|exists:supplier_infos,id',
            'stock_quantity' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'status' => 'required|in:in_stock,low_stock,out_of_stock,discontinued',
            'is_active' => 'required|boolean',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

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

        return redirect()->route('ViewProduct')->with('success', 'Product deleted successfully.');

      } catch (\Throwable $e) {
        return redirect()->back()->with('error', 'Product not found.' . $e->getMessage());
      } 
    }
}
