<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\payinout;
use App\Models\payoutcash;

class PayoutController extends Controller
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
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $user = User::find($id);
        if (auth()->user()->handmoney == 1) {
            return view('Payinout.payout', ['user' => $user]);
        } else {
            return response()->json(['You do not have permission to access for this page.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        // return $request->all();
        $userpayout = User::find($id);
        if ($userpayout->cash >= $request->Payoutcash) {
            $userpayout->cash = $userpayout->cash - $request->Payoutcash;
            $userpayout->payoutcash = $userpayout->payoutcash + $request->Payoutcash;
            $userpayout->save();

            $payinout_recode = new payoutcash;
            $payinout_recode->user_id = auth()->user()->id;
            $payinout_recode->payoutcash = $request->Payoutcash;
            $payinout_recode->discription = $request->discription;
            $payinout_recode->save();
            return back()->with('success', 'User Updated Successfully');
        };
        return back()->with('success', 'User Updated Successfully');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $user)
    {
        // return $request->all();
        $payinout_recode = new payinout;
        $payinout_recode->userid = $user;
        $payinout_recode->cash = $request->cash;
        $payinout_recode->card = $request->card;
        $payinout_recode->bank = $request->bank;
        $payinout_recode->consumer_credit = $request->consumer_credit;
        $payinout_recode->payoutdate = now()->format('Y-m-d');
        $payinout_recode->payincash = $request->payincash;
        $payinout_recode->payoutcash = $request->payoutcash;
        $payinout_recode->hand_money = $request->hand_money;
        $payinout_recode->bill_count = $request->bill_count;
        $payinout_recode->different = $request->different;
        $payinout_recode->updateby = auth()->user()->id;
        $payinout_recode->save();


        if (!$user) {
            return back()->with('error', 'User not found');
        }
        $user_pay_in = User::find($user);
        $user_pay_in->cash = 0;
        $user_pay_in->bank = 0;
        $user_pay_in->card = 0;
        $user_pay_in->consumer_credit = 0;
        $user_pay_in->payincash = 0;
        $user_pay_in->payoutcash = 0;
        $user_pay_in->hand_money = 0;
        $user_pay_in->bill_count = 0;
        $user_pay_in->update();

        return back()->with('success', 'User Updated Successfully');
    }


    public function destroy(User $user) {}
}
