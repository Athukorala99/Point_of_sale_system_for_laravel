<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\customerhistory;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(5);
        if (auth()->user()->customer_view == 1) {
            return view('customer.index', ['customers' => $customers]);
        } else {
            return response()->json(['You do not have permission to access for this page.']);
        }
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
        $countCustomer = Customer::where('email', $request->email)->count();
        $countCustomerp = Customer::where('phone', $request->phone)->count();
        if ($countCustomer > 0) {
            return redirect()->back()->with('error', 'Email already exists');
        } else if ($countCustomerp > 0) {
            return redirect()->back()->with('error', 'Phone number already exists');
        } else {
            $customers = Customer::create($request->all());
            if ($customers) {
                return redirect()->back()->with('success', 'Customer created successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $customerhistories = customerhistory::where('customer_id', $id)->get();
        if ($customer) {
            if (auth()->user()->customer_pay == 1) {
                return view('customer.paycustomer', ['customer' => $customer, 
                'customerhistories' => $customerhistories]);
            } else {
                return response()->json(['You do not have permission to access for this page.']);
            }
        } else {
            return redirect()->back()->with('error', 'Customer not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        //return $request->all();
        if ($customer->update($request->all())) {
            return redirect()->back()->with('success', 'Customer updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        $customer->delete($customer);
        return redirect()->back()->with('success', 'Customer deleted successfully');
    }
}
