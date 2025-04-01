<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;


use App\Models\permission;
use Exception;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('users.profile');
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
    public function show(User $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Auth::user()->id);

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);

        // Save the user instance
        
            $user->update($request->all());
            return back()->with('success', 'Password changed successfully.');
        
            return back()->withErrors(['error' => 'Failed to change password: ' . $e->getMessage()]);
    }

    public function userstatus($user)
    {
        //
    }
    public function destroy(User $user)
    {
        //
    }

    public function changepassword(){
        return view('users.changepassword');
    }

    
}
