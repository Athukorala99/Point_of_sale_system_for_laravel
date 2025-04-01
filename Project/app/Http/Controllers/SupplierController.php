<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(5);
        if (auth()->user()->supplier_view == 1) {

            return view('supplier.index', ['suppliers' => $suppliers]);
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

        $countSupplier = Supplier::where('email', $request->email)->count();
        $countSupplierp = Supplier::where('phone', $request->phone)->count();
        if ($countSupplier > 0) {
            return redirect()->back()->with('error', 'Email already exists');
        } else if ($countSupplierp > 0) {
            return redirect()->back()->with('error', 'Phone number already exists');
        } else {
            $suppliers = Supplier::create($request->all());
            if ($suppliers) {
                return redirect()->back()->with('success', 'Suppliers Add Successfully');
            } else {
                return redirect()->back()->with('error', 'Suppliers Add Failed');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        if (!$supplier) {
            return back()->with('error', 'Suppliers not found');
        }
        $supplier->update($request->all());

        return back()->with('success', 'Suppliers Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        if (!$supplier) {
            return back()->with('error', 'Supplier not found');
        }
        $supplier->delete();

        return back()->with('success', 'Supplier Delete Successfully');
    }
}
