<?php

namespace App\Http\Controllers;

use App\Models\delete_order;
use App\Models\delete_order_details;
use Illuminate\Http\Request;
use App\Models\Cart;


class DeleteOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        //delete order model
        $delete_orders = new delete_order;
        $delete_orders->userid = auth()->user()->id;
        $delete_orders->save();
        $delete_orders_id = $delete_orders->id;
        $priceo = 0;
        for ($product_id_del = 0; $product_id_del < count($request->product_id_del); $product_id_del++) 
        {
            $delete_order_details = new delete_order_details;
            $delete_order_details->del_order_id = $delete_orders_id;
            $delete_order_details->product_id =$request->product_id_del[$product_id_del];
            $delete_order_details->quantity = $request->quantity_del[$product_id_del];
            $delete_order_details->price = $request->price_del[$product_id_del];
            $delete_order_details->save();
            $priceo = $priceo + ($request->price_del[$product_id_del] * $request->quantity_del[$product_id_del]);
        } 
        $delete_orders_id = $delete_orders->id;
        $delete_order_select = delete_order::find($delete_orders_id);
        $delete_order_select->total = $priceo;
        $delete_order_select->save();
        Cart::where('user_id', auth()->user()->id)->delete();
        return back()->with('info', 'Order Successfully Delete');
    }

    /**
     * Display the specified resource.
     */
    public function show(delete_order $delete_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(delete_order $delete_order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, delete_order $delete_order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(delete_order $delete_order)
    {
        //
    }
}
