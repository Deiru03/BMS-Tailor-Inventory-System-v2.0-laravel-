<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $productTypes = ProductType::all();

        return view('settings.Settings', [
            'productTypes' => $productTypes,
            'user' => $request-> user(),
        ]);
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

    public function productTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $productType = new ProductType();
        $productType->name = $request->input('name');
        $productType->description = $request->input('description');
        $productType->save();

        return redirect()->back()->with('success', 'Product type created successfully.');
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

    public function productTypeEdit(string $id)
    {
        try {
            $productType = ProductType::findOrFail($id);
            return view('settings.product-settings-form', compact('productType'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to fetch product type: ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function productTypeUpdate(Request $request, string $id)
    {
        try {
            
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);
    
            $productType = ProductType::findOrFail($id);
            $productType->name = $request->input('name');
            $productType->description = $request->input('description');
            $productType->save();
    
            return redirect()->back()->with('success', 'Product type updated successfully.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update product type: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function productTypeDestroy(string $id)
    {
        $productType = ProductType::findOrFail($id); // Find the product type by ID
        $productType->delete(); // Delete the product type
        return redirect()->back()->with('success', 'Product type deleted successfully.');
    }
}
