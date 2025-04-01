<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\customer;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\transaction;
use Illuminate\Support\Facades\DB;

class PayinoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->payin_out == 1) {

            $users = User::paginate(5);
            return view('Payinout.index', ['users' => $users]);
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
        // return $request->all();
        $user = User::find(auth()->user()->id);
        $user->hand_money = $request->handmoney;
        $user->save();
        return back()->with('success', 'User Updated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.usermoney', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $user)
    {
        if (!$user) {
            return back()->with('error', 'User not found');
        }
        $user_pay_in = User::find($user);
        $user_pay_in->cash = $user_pay_in->cash + $request->cash;
        $user_pay_in->payincash = $user_pay_in->payincash + $request->cash;
        $user_pay_in->update();

        // $user->update($request->all());


        return back()->with('success', 'User Updated Successfully');
    }


    public function destroy(User $user) {}
}
