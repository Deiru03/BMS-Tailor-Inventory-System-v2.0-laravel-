<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierInfo;
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

             //
            $request->validate([
                'name' => 'required|string|max:255',
                'contact_person' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'province' => 'nullable|string|max:100',
                'tin' => 'nullable|string|max:50',
                'supplier_type' => 'required|in:fabric,accessories,thread,buttons,zippers,equipment,other',
                'notes' => 'nullable|string'
            ]);

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
            $supplier->supplier_type = $request->supplier_type;
            $supplier->is_active = true;
            $supplier->notes = $request->notes;
            $supplier->save();
            
            return redirect()->route('ViewSupplier')
                ->with('success', 'Supplier created successfully');
        }
        catch (\Exception $e){
            return redirect()->route('ViewSupplier')
                ->with('error', 'An error occurred while creating the supplier');
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
        $supplier = SupplierInfo::findOrFail($id);
        return view('components.supplier-modals.supplier-edit', compact('supplier'));
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
