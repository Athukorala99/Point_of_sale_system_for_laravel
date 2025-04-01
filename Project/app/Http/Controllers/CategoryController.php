<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::paginate(5);
        // $categories = category::all();
        if (auth()->user()->caregory_view == 1) {
            return view('categorys.index', ['categories' => $categories]);
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
        $categories = category::create($request->all());

        if ($categories) {
            return redirect()->back()->with('success', 'Category Created Successfully');
        }
        return redirect()->back()->with('error', 'Category Created Failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        if (!$category) {
            return back()->with('error', 'Category not found');
        }
        $category->update($request->all());


        return back()->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        if (!$category) {
            return back()->with('error', 'Category not found');
        }
        $category->delete();

        return back()->with('success', 'Category Delete Successfully');
    }
}
