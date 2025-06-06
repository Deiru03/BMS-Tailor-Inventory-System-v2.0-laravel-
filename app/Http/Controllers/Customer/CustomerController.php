<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomersInfo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'nullable|email|max:255',
                'phone'   => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'sex'     => 'required|in:male,female',
                'notes'   => 'nullable|string'  
            ]);
                $customer = new CustomersInfo();
                $customer->name       = $request->name;
                $customer->email      = $request->email;
                $customer->phone      = $request->phone;
                $customer->address    = $request->address;
                $customer->sex        = $request->sex;
                $customer->notes      = $request->notes;
                $customer->customer_id = 'CUST-' . strtoupper(Str::random(6));
                $customer->save();
                
            return redirect()->route('ViewCustomer')
                    ->with('success', 'Customer created successfully');
        } 
        catch (\Exception $e){
            return redirect()->route('ViewCustomer')
                ->with('error', 'An error occurred while creating the customer');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the customer by ID
        $customer = CustomersInfo::findOrFail($id);
        
        // Return the customer details view with customer data
        return view('components.customer-modals.customer-show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the customer record or fail if not found
        $customer = CustomersInfo::findOrFail($id);
        
        // Load the edit blade, passing the customer data
        return view('components.customer-modals.customer-edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'nullable|email|max:255',
                'phone'   => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'sex'     => 'required|in:male,female',
                'notes'   => 'nullable|string',
                'purchased_amount' => 'required|numeric',
                'amount_paid'      => 'required|numeric',
                'balance'          => 'required|numeric'
            ]);
    
            // Find the customer record
            $customer = CustomersInfo::findOrFail($id);
    
            // Update the customer fields
            $customer->name    = $request->name;
            $customer->email   = $request->email;
            $customer->phone   = $request->phone;
            $customer->address = $request->address;
            $customer->sex     = $request->sex;
            $customer->notes   = $request->notes;
            $customer->purchased_amount = $request->purchased_amount;
            $customer->amount_paid      = $request->amount_paid;
            $customer->balance          = $request->balance;
    
            // Save changes
            $customer->save();
    
            // Redirect back with success message
            return redirect()->route('ViewCustomer')
                ->with('success', 'Customer updated successfully');
    
        } catch (\Exception $e) {
            return redirect()->route('ViewCustomer')
                ->with('error', 'Failed Updating the Customer');
        }// Validate input
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $userid = CustomersInfo::find($id);
            $userid->delete();
            return redirect()->route('ViewCustomer')
                ->with('success', 'Customer deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->route('ViewCustomer')
                ->with('error', 'An error occurred while deleting the customer');
        }
       
    }
}
