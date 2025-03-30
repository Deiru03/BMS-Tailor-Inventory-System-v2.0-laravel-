<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierInfo;
use App\Models\SupplierType;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name'           => 'required|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'email'          => 'nullable|email|max:255',
                'phone'          => 'required|string|max:20',
                'address'        => 'nullable|string|max:255',
                'city'           => 'nullable|string|max:100',
                'province'       => 'nullable|string|max:100',
                'tin'            => 'nullable|string|max:50',
                'supplier_types' => 'required|array', // Validate as an array
                'supplier_types.*' => 'exists:supplier_types,id', // Ensure each type exists
                'notes'          => 'nullable|string',
            ]);
    
            // Create the supplier
            $supplier = new SupplierInfo();
            $supplier->supplier_id = 'SUP-' . strtoupper(Str::random(6));
            $supplier->name = $request->name;
            $supplier->contact_person = $request->contact_person;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->city = $request->city;
            $supplier->province = $request->province;
            $supplier->tin = $request->tin;
            $supplier->notes = $request->notes;
            $supplier->is_active = true;
            $supplier->save(); // Save the supplier first
    
            // Attach the selected supplier types
            $supplier->types()->attach($request->supplier_types);
    
            return redirect()->route('ViewSupplier')
                ->with('success', 'Supplier created successfully');
        } catch (\Exception $e) {
            return redirect()->route('ViewSupplier')
                ->with('error', 'An error occurred while creating the supplier: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = SupplierInfo::findOrFail($id);

        // Get the supplier types
        $supplierTypes = $supplier->types()->pluck('name')->toArray();
        $supplier->supplier_types = implode(', ', $supplierTypes);
        $supplier->supplier_type = $supplier->supplier_types;
        return view('components.supplier-modals.supplier-show', compact('supplier', 'supplierTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = SupplierInfo::findOrFail($id);

        $supplierTypes = $supplier->types()->pluck('name')->toArray();

        return view('components.supplier-modals.supplier-edit', compact('supplier', 'supplierTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'name'           => 'required|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'email'          => 'nullable|email|max:255',
                'phone'          => 'required|string|max:20',
                'address'        => 'nullable|string|max:255',
                'city'           => 'nullable|string|max:100',
                'province'       => 'nullable|string|max:100',
                'tin'            => 'nullable|string|max:50',
                'supplier_types' => 'required|array', // Validate as an array
                'supplier_types.*' => 'exists:supplier_types,id', // Ensure each type exists
                'notes'          => 'nullable|string',
            ]);
    
            // Find the supplier
            $supplier = SupplierInfo::findOrFail($id);
    
            // Update the supplier data
            $supplier->name = $request->name;
            $supplier->contact_person = $request->contact_person;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->city = $request->city;
            $supplier->province = $request->province;
            $supplier->tin = $request->tin;
            $supplier->notes = $request->notes;
            $supplier->save();
    
            // Sync the selected supplier types
            $supplier->types()->sync($request->supplier_types);
    
            return redirect()->route('ViewSupplier')
                ->with('success', 'Supplier updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('ViewSupplier')
                ->with('error', 'An error occurred while updating the supplier: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $supplier = SupplierInfo::findOrFail($id);
            $supplier->delete();

            return redirect()->route('ViewSupplier')
                ->with('success', 'Supplier deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('ViewSupplier')
                ->with('error', 'An error occurred while deleting the supplier');
        }
        
    }
}
