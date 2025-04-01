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
        return view('company.CompanyDetails', ['companies' => $companies]);
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


    public function update(Request $request, $id)
    {
        // Validate form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Fetch the correct company record
        $company = Companies::findOrFail($id);

        // Check if a new logo is uploaded
        if ($request->hasFile('company_logo')) {
            // Delete the old logo if it exists in storage
            if ($company->company_logo && Storage::disk('public')->exists($company->company_logo)) {
                Storage::disk('public')->delete($company->company_logo);
            }

            // Get the file extension (jpg, png, etc.)
            $extension = $request->file('company_logo')->getClientOriginalExtension();

            // Define the new filename as "logo.extension"
            $newFileName = "logo." . $extension;

            // Store the file in "images/logo/" with the new filename
            $logopath = $request->file('company_logo')->storeAs('images/logo', $newFileName, 'public');

            // Update the logo path in the database
            $company->company_logo = $logopath;
        }

        // Update other company details
        $company->company_name = $request->name;
        $company->company_address = $request->address;
        $company->company_email = $request->email;
        $company->company_phone = $request->phone;

        // Save updated data
        $company->save();

        return redirect()->back()->with('success', 'Company details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Companies $companies)
    {
        //
    }
}
