<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::paginate(5);
        if (auth()->user()->user_view == 1) {
            return view('users.index', ['users' => $users]);
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
        $countUser = User::where('email', $request->email)->count();
        if ($countUser > 0) {
            return redirect()->back()->with('error', 'Email already exists');
        } else {
            $users = User::create($request->all());
            if ($users) {


                return redirect()->back()->with('success', 'User Created Successfully');
            }
            return redirect()->back()->with('error', 'User Created Failed');
        }
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
        if (!$user) {
            return back()->with('error', 'User not found');
        }
        $user->update($request->all());


        return back()->with('success', 'User Updated Successfully');
    }

    public function userstatus($user)
    {
        $user = User::find($user);
        if (!$user) {
            return back()->with('error', 'User not found');
        }
        $user->is_active = !$user->is_active;
        $user->save();
        return back()->with('success', 'User Status Updated Successfully');
    }
    public function destroy(User $user)
    {

        if (!$user) {
            return back()->with('error', 'User not found');
        }
        $user->delete();

        return back()->with('success', 'User Delete Successfully');
    }
}
