<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Companies::where('id', 1)->get();
        // $companies = Companies::all();
        return view('company.CompanyDetails',['companies' => $companies]);
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

    /**
     * Display the specified resource.
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Companies $companies)
    {
        // if ($companies->update($request->all())) {
        //     return redirect()->back()->with('success', 'Company details updated successfully');
        // }
        // return $request->all();
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'phone' => 'required|string|max:255',            
        //     'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        // ]);

        
        if($request->hasFile('company_logo')){
            $logopath = $request->file('company_logo')->store('images/logo', 'public');            
        }

        // $companies = Companies::first();
        $companies = Companies::find(1);
        $companies->company_name = $request->name;
        $companies->company_address = $request->address;
        $companies->company_email = $request->email;
        $companies->company_phone = $request->phone;

        if(isset($logopath)){
            $companies->company_logo = $logopath;
        }
        $companies->update();

        return redirect()->back()->with('success', 'Company details updated successfully');
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Companies $companies)
    {
        //
    }
}
