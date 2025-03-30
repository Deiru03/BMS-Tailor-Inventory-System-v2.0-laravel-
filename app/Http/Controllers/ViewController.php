<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\CustomersInfo;
use App\Models\SupplierInfo;
use App\Models\SupplierType;
use App\Models\Material as MaterialInfo;


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
}
