<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\CustomersInfo;
use App\Models\SupplierInfo;
use App\Models\Material as MaterialInfo;


class ViewController extends Controller
{
    //------------------------- Sidebar Buttons and Routes ------------------------- //
    public function customer(){

        $customers = CustomersInfo::all();

        return view('customers', compact('customers'));
    }

    public function supplier(){
        
        $suppliers = SupplierInfo::all();

        return view('suppliers', compact('suppliers'));
    }

    public function material(){
        
        $materials = MaterialInfo::all();

        return view('materials', compact('materials'));
    }
}
