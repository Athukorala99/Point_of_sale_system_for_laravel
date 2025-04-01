<?php

namespace App\Http\Controllers;

use App\Models\Hold_order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Order_detail;
use App\Models\customer;
use App\Models\Hold_orderDetail;
use Illuminate\Http\Request;
use App\Models\delete_order;
use App\Models\delete_order_details;


class HoldOrderController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $hold_order = new Hold_order;
        $hold_order->user_id = auth()->user()->id;
        $hold_order->date = now()->toDateString();
        $hold_order->save();
        $holdid = $hold_order->id;

        for ($product_id_hold = 0; $product_id_hold < count($request->product_id_hold); $product_id_hold++) {
            $hold_order_detail = new Hold_orderDetail;
            $hold_order_detail->hold_id = $holdid;
            $hold_order_detail->product_id = $request->product_id_hold[$product_id_hold];
            $hold_order_detail->barcode = $request->barcode[$product_id_hold];
            $hold_order_detail->product_qty = $request->quantity_hold[$product_id_hold];
            $hold_order_detail->product_price =$request->total_amount_hold[$product_id_hold];
            $hold_order_detail->discount =$request->discount[$product_id_hold];
            $hold_order_detail->user_id = auth()->user()->id;
            $hold_order_detail->save();
        }

        Cart::where('user_id', auth()->user()->id)->delete();
        return back()->with('info', 'Order Successfully inserted');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hold_order $hold_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hold_order $hold_order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $hold_order)
    {
        //  return $request->all();
        
        $orderd = Hold_order::find($hold_order);
        $holdid = $orderd->id;

        $order_details = Hold_orderDetail::where('hold_id', $request->holdlist_id)->get();
        foreach($order_details as $order_detail){
            $cart_hold_add = new Cart;
            $cart_hold_add->product_id = $order_detail->product_id;
            $cart_hold_add->barcode = $order_detail->barcode;
            $cart_hold_add->product_qty = $order_detail->product_qty;
            $cart_hold_add->product_price = $order_detail->product_price;
            $cart_hold_add->discount = $order_detail->discount;
            $cart_hold_add->user_id = $order_detail->user_id;
            $cart_hold_add->save();
        }


        $orderd->delete();

        Hold_orderDetail::where('hold_id', $holdid)->delete();
        return back()->with('success', 'Order delete hold inserted');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($hold_order)
    {
        $orderd = Hold_order::find($hold_order);
        $holdid = $orderd->id;

        $delete_orders = new delete_order;
        $delete_orders->userid = auth()->user()->id;
        $delete_orders->save();
        $delete_orders_id = $delete_orders->id;
        $priceo = 0;

        $order_details = Hold_orderDetail::where('hold_id', $holdid)->get();
        foreach($order_details as $order_detail){
            $delete_order_details = new delete_order_details;
            $delete_order_details->del_order_id = $delete_orders_id;
            $delete_order_details->product_id = $order_detail->product_id;
            $delete_order_details->quantity = $order_detail->product_qty;
            $delete_order_details->price = $order_detail->product_price / $order_detail->product_qty;
            $delete_order_details->save();
            $priceo = $priceo + $order_detail->product_price;
        }
     
        $delete_orders_id = $delete_orders->id;
        $delete_order_select = delete_order::find($delete_orders_id);
        $delete_order_select->total = $priceo;
        $delete_order_select->save();
       
        $orderd->delete();

        Hold_orderDetail::where('hold_id', $holdid)->delete();
        return back()->with('info', 'Order delete hold inserted');

    }
}
