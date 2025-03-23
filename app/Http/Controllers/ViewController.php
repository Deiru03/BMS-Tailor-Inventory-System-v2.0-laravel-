<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\CustomersInfo;



class ViewController extends Controller
{
    //------------------------- Sidebar Buttons and Routes ------------------------- //
    public function customer(){
        return view('customers');
    }

    public function supplier(){
        return view('suppliers');
    }

    // public function products(){
    //     return view('products');
    // }
}
