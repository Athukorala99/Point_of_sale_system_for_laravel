<?php

namespace App\Http\Controllers;

use App\Models\customerhistory;
use Illuminate\Http\Request;
use App\Models\customer;

class CustomerhistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

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
        // return $request->all();
        $customerbilno = customerhistory::max('id') + 1;


        $Customer = customer::find($request->customer_id);
        $Customer->amount = $Customer->amount - $request->ppaying_amount;
        $Customer->update();


        $cushistory = new customerhistory;
        $cushistory->customer_id = $request->customer_id;
        $cushistory->date = now()->toDateString();
        $cushistory->billno = "P".$customerbilno;
        $cushistory->amount = $request->ppaying_amount;
        $cushistory->balance = $request->aamount-$request->ppaying_amount;
        $cushistory->save(); 
        return redirect()->back()->with('success', 'Customer updated successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(customerhistory $customerhistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customerhistory $customerhistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customerhistory $customerhistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customerhistory $customerhistory)
    {
        //
    }
}
