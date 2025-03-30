<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            // Validate the request data
            $request->validate([
                'material_code'   => 'required|string|max:50|unique:materials,material_code',
                'name'            => 'required|string|max:255',
                'supplier_id'     => 'required|exists:supplier_infos,id',
                'supplier_type_name' => 'nullable|string|max:255',
                'description'     => 'nullable|string',
                'type'            => 'nullable|string|max:100',
                'color'           => 'nullable|string|max:50',
                'pattern'         => 'nullable|string|max:50',
                'composition'     => 'nullable|string|max:255',
                'width'           => 'nullable|numeric|min:0',
                'weight'          => 'nullable|numeric|min:0',
                'quality_grade'   => 'nullable|string|max:50',
                'stock_quantity'  => 'required|numeric|min:0',
                'unit'            => 'nullable|string|max:50',
                'unit_price'      => 'nullable|numeric|min:0',
                'cost_price'      => 'nullable|numeric|min:0',
                'reorder_level'   => 'nullable|integer|min:0',
                'location'        => 'nullable|string|max:255',
                'status'          => 'nullable|in:in_stock,out_of_stock,discontinued', // Validate ENUM values
                'is_active'       => 'required|boolean',
            ]);

            // Create the material
            $material = new Material();
            $material->material_code = $request->material_code;
            $material->name = $request->name;
            $material->supplier_id = $request->supplier_id;
            $material->supplier_type_name = $request->supplier_type_name; // Optional
            $material->description = $request->description ?? 'No description provided';
            $material->type = $request->type ?? 'Unknown';
            $material->color = $request->color;
            $material->pattern = $request->pattern;
            $material->composition = $request->composition;
            $material->width = $request->width;
            $material->weight = $request->weight;
            $material->quality_grade = $request->quality_grade;
            $material->stock_quantity = $request->stock_quantity; // Required
            $material->unit = $request->unit ?? 'meter'; // Default to 'meter'
            $material->unit_price = $request->unit_price;
            $material->cost_price = $request->cost_price;
            $material->reorder_level = $request->reorder_level;
            $material->location = $request->location;
            $material->status = $request->status ?? 'in_stock'; // Default to 'in_stock'
            $material->is_active = $request->is_active;
            $material->save();

            // Redirect with success message
            return redirect()->route('ViewMaterial')
                ->with('success', 'Material created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'An error occurred while creating the material: ' . $th->getMessage());
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
        //
    }
}
