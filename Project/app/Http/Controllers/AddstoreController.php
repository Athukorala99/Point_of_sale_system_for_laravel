<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Companies;
use App\Models\Order;
use App\Models\customer;
use App\Models\Order_detail;
use App\Models\transaction;
use App\Models\addstore;
use App\Models\addstoredetails;
use App\Models\addstorecart;
use App\Models\User;

class AddstoreController extends Controller
{
    public  function index()
    {
        $products = Product::paginate(5);
        $categories = Category::all();
        $suppliers = Supplier::all();
        $orders = addstore::all();
        $lastID = addstore::where('user_id', auth()->user()->id)->max('id');
        
        // new added variables
        $invoice = addstore::where('id',$lastID)->first();
        $reciptno = addstore::where('id',$lastID)->value('bill_number');
        $supplierr = addstore::where('id',$lastID)->value('Supplier');
        $billingdate = addstore::where('id',$lastID)->value('addstore_date');
        $amount = addstore::where('id',$lastID)->value('amount');
        $discount = addstore::where('id',$lastID)->value('discount');
        $createdate = addstore::where('id',$lastID)->value('created_at');



        $supp = Supplier::where('id', $supplierr)->first();
        $suppliersr = $supp->supplier_name;
        // new added variables


        $order_recept = addstoredetails::where('addstore_id', $lastID)->get();
        $transactionsdate = addstore::where('addstore_id', $lastID)->value('created_at');
        $paidcash = addstore::where('addstore_id', $lastID)->value('amount');
        $customer = customer::all();
        $companies = Companies::all();
        if (auth()->user()->addstore_view == 1) {

            return view('products.addstore', ['suppliersr'=>$suppliersr,'createdate'=>$createdate,'discount'=>$discount,'amount'=>$amount,'billingdate'=>$billingdate ,'supplierr'=>$supplierr,'reciptno'=>$reciptno,'invoice' => $invoice ,'suppliers' => $suppliers, 'categories' => $categories, 'customer' => $customer, 'products' => $products, 'orders' => $orders, 'order_recept' => $order_recept, 'transactionsdate' => $transactionsdate, 'paidcash' => $paidcash, 'lastID' => $lastID, 'companies' => $companies]);
        } else {
            return response()->json(['You do not have permission to access for this page.']);
        }
    }
    public function grnview()
    {
        $addstores = addstore::all();
        if (auth()->user()->addstore_list == 1) {
            return view('products.grnlist', ['addstores' => $addstores]);
        } else {
            return response()->json(['You do not have permission to access for this page.']);
        }
    }
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

        $addstore = new addstore;
        $addstore->addstore_id = 1;
        $sup = Supplier::where('phone', $request->supplier_phone)->first();
        $addstore->Supplier = $sup->id;
        if (!$request->balance) {
            $addstore->amount = $request->total;
        } else {
            $addstore->amount = $request->balance;
        }
        $addstore->bill_number = $request->invoice_no;
        if (!$request->discount) {
            $addstore->discount = 0;
        } else {
            $addstore->discount = $request->discount;
        }
        $addstore->user_id = auth()->user()->id;
        $addstore->addstore_date = $request->date;
        $addstore->bill_date = now()->toDateString();
        $addstore->save();
        $addstore_id =   $addstore->id;

        for ($product_id = 0; $product_id < count($request->product_id); $product_id++) {
            $addstoredetails = new addstoredetails;
            $addstoredetails->addstore_id = $addstore_id;
            $addstoredetails->batch_no = 1;
            $addstoredetails->product_id = $request->product_id[$product_id];
            $addstoredetails->quantity = $request->quantity[$product_id];
            $addstoredetails->stock_quantity = $request->quantity[$product_id];
            $addstoredetails->unitprice = $request->price[$product_id];
            $addstoredetails->amount = $request->total_amount[$product_id];
            $addstoredetails->userid = auth()->user()->id;
            $addstoredetails->save();



            $product_details = Product::find($request->product_id[$product_id]);
            $product_details->quantity = $product_details->quantity + $request->quantity[$product_id];
            $product_details->save();
        }
        addstorecart::where('user_id', auth()->user()->id)->delete();

        return back()->with('success', 'Product Successfully inserted');
    }

    /**
     * Display the specified resource.
     */
    public function show($grnid)
    {
        $addstore = addstore::find($grnid);
        $addstoredetails = addstoredetails::where('addstore_id', $grnid)->get();
        $supplier = Supplier::where('phone', $addstore->Supplier)->first();
        
        // new added variables
        $invoice = addstore::find($grnid);
        $lastID = $grnid;
        $order_recept = addstoredetails::where('addstore_id', $grnid)->get();
        $reciptno = addstore::where('id',$grnid)->value('bill_number');
        $supplierr = addstore::where('id',$grnid)->value('Supplier');
        $billingdate = addstore::where('id',$grnid)->value('addstore_date');
        $amount = addstore::where('id',$grnid)->value('amount');
        $discount = addstore::where('id',$grnid)->value('discount');
        $createdate = addstore::where('id',$grnid)->value('created_at');

        $supp = Supplier::where('id', $supplierr)->first();
        $suppliersr = $supp->supplier_name;
        // new added variables

        if (auth()->user()->addstore_bill == 1) {
            return view( 'products.grnbill', ['suppliersr' => $suppliersr,'lastID'=>$lastID,'createdate'=>$createdate,'discount'=>$discount,'amount'=>$amount,'billingdate'=>$billingdate ,'supplierr'=>$supplierr,'reciptno'=>$reciptno,'order_recept' => $order_recept , 'invoice' => $invoice ,'addstore' => $addstore, 'addstoredetails' => $addstoredetails, 'supplier' => $supplier]);
        } else {
            return response()->json(['You do not have permission to access for this page.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaction $transaction)
    {
        //
    }
}
