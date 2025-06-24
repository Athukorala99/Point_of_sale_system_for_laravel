<?php


namespace App\Http\Controllers;

use App\Models\addstore;
use App\Models\addstoredetails;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order_detail;
use App\Models\Transaction;
use App\Models\Cart;
use App\Models\customer;
use App\Models\User;
use App\Models\Companies;
use App\Models\customerhistory;
use App\Models\profitdetails;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        $lastID = Transaction::where('user_id', auth()->user()->id)->max('order_id');

        $order_recept = Order_detail::where('order_id', $lastID)->get();
        $transactionsdate = Transaction::where('order_id', $lastID)->value('created_at');
        $paidcash = Transaction::where('order_id', $lastID)->value('paid_amount');
        $customer = customer::all();
        $companies = Companies::all();
        if (auth()->user()->order_view == 1) {

            return view('orders.index', ['customer' => $customer, 'products' => $products, 'orders' => $orders, 'order_recept' => $order_recept, 'transactionsdate' => $transactionsdate, 'paidcash' => $paidcash, 'lastID' => $lastID, 'companies' => $companies]);
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

        if (!$request->customer_phone && !$request->paid_amount) {
            return back()->with('error', 'Please enter customer phone number Or paid amount');
        } else {
            if (!$request->customer_phone) {
                // return back()->with('error', 'Please enter customer phone');
                if ($request->balance < 0) {
                    return back()->with('error', 'Please enter correct amount');
                } else {
                    // return $request->all();
                    \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
                        //Order model
                        $orders = new Order;
                        $orders->name = $request->customer_name;
                        $orders->phone = $request->customer_phone;
                        $orders->save();
                        $order_id =   $orders->id;

                        //order detail modeal
                        $transac = 0;
                        for ($product_id = 0; $product_id < count($request->product_id); $product_id++) {
                            $order_details = new Order_detail;
                            $order_details->order_id = $order_id;
                            $order_details->product_id = $request->product_id[$product_id];
                            $order_details->quantity = $request->quantity[$product_id];
                            $order_details->unitprice = $request->price[$product_id];
                            $order_details->orginal_price = $request->orginal_price[$product_id];
                            $order_details->amount = $request->total_amount[$product_id];
                            $order_details->userid = auth()->user()->id;
                            $order_details->save();
                            $product_details = Product::find($request->product_id[$product_id]);
                            $product_details->quantity = $product_details->quantity - $request->quantity[$product_id];
                            $product_details->save();

                            $qty = $request->quantity[$product_id];

                            $grnproducts = addstoredetails::where('product_id', $request->product_id[$product_id])->get();

                            if ($grnproducts) {
                                foreach ($grnproducts as $grnproduct) {
                                    $qty;
                                    if ($grnproduct->stock_quantity == '0') {
                                        continue;
                                    } else {
                                        if ($grnproduct->stock_quantity < $qty) {
                                            $abc = $qty - $grnproduct->stock_quantity;
                                            $qty = $abc;
                                            // proft Table 
                                            $profit = new profitdetails;
                                            $profit->order_id = $order_id;
                                            $profit->product_id = $request->product_id[$product_id];
                                            $profit->addstoredetail_id = $grnproduct->id;
                                            $profit->quantity = $grnproduct->stock_quantity;
                                            $profit->profit = $request->price[$product_id] - $grnproduct->unitprice;
                                            $profit->date = now()->toDateString();
                                            $profit->user_id = auth()->user()->id;
                                            $profit->save();
                                            $grnproduct->stock_quantity = 0;
                                            $grnproduct->save();
                                        } else {


                                            // proft Table
                                            $profit = new profitdetails;
                                            $profit->order_id = $order_id;
                                            $profit->product_id = $request->product_id[$product_id];
                                            $profit->addstoredetail_id = $grnproduct->id;
                                            $profit->quantity = $qty;
                                            $profit->profit = $request->price[$product_id] - $grnproduct->unitprice;
                                            $profit->date = now()->toDateString();
                                            $profit->user_id = auth()->user()->id;
                                            $profit->save();

                                            
                                            $grnproduct->stock_quantity = $grnproduct->stock_quantity - $qty;
                                            $grnproduct->save();
                                            break;
                                        }
                                    }
                                }
                            } else {
                                // Handle the case where no matching records are found
                                return response()->json(['error' => 'No stock details found for product ID: ' . $request->product_id[$product_id]]);
                            }
                        }
                        //transaction modal
                        $transactions = new Transaction;
                        $transactions->order_id = $order_id;
                        $transactions->user_id = auth()->user()->id;
                        $transactions->balance = $request->balance;
                        $transactions->paid_amount = $request->paid_amount;
                        $transactions->transac_amount = $transac;
                        $transactions->transac_date = now()->toDateString();
                        $transactions->cash = $request->cash - $request->balance;
                        $transactions->bank = $request->bank;
                        $transactions->credit_card = $request->credit_card;
                        $transactions->save();

                        $user_amount = User::find(auth()->user()->id);
                        $user_amount->cash = $user_amount->cash + $request->cash - $request->balance;
                        $user_amount->bill_count = $user_amount->bill_count + 1;
                        $user_amount->bank = $user_amount->bank + $request->bank;
                        $user_amount->card = $user_amount->card + $request->credit_card;
                        $user_amount->save();

                        Cart::where('user_id', auth()->user()->id)->delete();

                        $products = Product::all();
                        $order_details = Order_detail::where('order_id', $order_id)->get();
                        $orderedBy = Order::where('id', $order_id)->get();

                        return view('orders.index', ['products' => $products, 'order_details' => $order_details, 'customer_orders' => $orderedBy]);
                    });
                    // return "Order Failed to inserted check your inputs";
                    return back()->with('success', 'Order Successfully inserted');
                }
            } else {
                if (!$request->balance) {
                    // return $request->all();
                    \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
                        //Order model
                        $orders = new Order;
                        $orders->name = $request->customer_name;
                        $orders->phone = $request->customer_phone;
                        $orders->save();
                        $order_id =   $orders->id;

                        //order detail modeal


                        $transac = 0;
                        for ($product_id = 0; $product_id < count($request->product_id); $product_id++) {
                            $order_details = new Order_detail;
                            $order_details->order_id = $order_id;
                            $order_details->product_id = $request->product_id[$product_id];
                            $order_details->quantity = $request->quantity[$product_id];
                            $order_details->unitprice = $request->price[$product_id];
                            $order_details->orginal_price = $request->orginal_price[$product_id];
                            $order_details->amount = $request->total_amount[$product_id];
                            $order_details->userid = auth()->user()->id;
                            $order_details->save();
                            $transac = $transac + $request->total_amount[$product_id];



                            $product_details = Product::find($request->product_id[$product_id]);
                            $product_details->quantity = $product_details->quantity - $request->quantity[$product_id];
                            $product_details->save();

                            $qty = $request->quantity[$product_id];

                            $grnproducts = addstoredetails::where('product_id', $request->product_id[$product_id])->get();

                            if ($grnproducts) {
                                foreach ($grnproducts as $grnproduct) {
                                    $qty;
                                    if ($grnproduct->stock_quantity == '0') {
                                        continue;
                                    } else {
                                        if ($grnproduct->stock_quantity < $qty) {
                                            $abc = $qty - $grnproduct->stock_quantity;
                                            $qty = $abc;


                                             // proft Table 
                                             $profit = new profitdetails;
                                             $profit->order_id = $order_id;
                                             $profit->product_id = $request->product_id[$product_id];
                                             $profit->addstoredetail_id = $grnproduct->id;
                                             $profit->quantity = $grnproduct->stock_quantity;
                                             $profit->profit = $request->price[$product_id] - $grnproduct->unitprice;
                                             $profit->date = now()->toDateString();
                                             $profit->user_id = auth()->user()->id;
                                             $profit->save();



                                            $grnproduct->stock_quantity = 0;
                                            $grnproduct->save();
                                        } else {

                                            // proft Table
                                            $profit = new profitdetails;
                                            $profit->order_id = $order_id;
                                            $profit->product_id = $request->product_id[$product_id];
                                            $profit->addstoredetail_id = $grnproduct->id;
                                            $profit->quantity = $qty;
                                            $profit->profit = $request->price[$product_id] - $grnproduct->unitprice;
                                            $profit->date = now()->toDateString();
                                            $profit->user_id = auth()->user()->id;
                                            $profit->save();


                                            $grnproduct->stock_quantity = $grnproduct->stock_quantity - $qty;
                                            $grnproduct->save();
                                            break;
                                        }
                                    }
                                }
                            } else {
                                // Handle the case where no matching records are found
                                return response()->json(['error' => 'No stock details found for product ID: ' . $request->product_id[$product_id]]);
                            }
                        }





                        //transaction modal
                        $transactions = new Transaction;
                        $transactions->order_id = $order_id;
                        $transactions->user_id = auth()->user()->id;
                        $transactions->balance = $order_details->amount;
                        $transactions->paid_amount = $request->paid_amount;
                        // $transactions->payment_method = $request->input_method;
                        $transactions->transac_amount =$transac;
                        $transactions->transac_date = now()->toDateString();
                        $transactions->cash = $request->cash - $request->balance;
                        $transactions->bank = $request->bank;
                        $transactions->credit_card = $request->credit_card;
                        $transactions->consumer_credit = $order_details->amount;
                        $transactions->save();
                        $balan = $transactions->transac_amount;


                        $customid = customer::where('phone', $request->customer_phone)->first('id');

                        $customerr = customer::find($customid->id);
                        $customerr->amount = $customerr->amount + $balan;
                        $customerr->update();


                        $customerhistory = new customerhistory;
                        $customerhistory->customer_id = $customid->id;
                        $customerhistory->date = now()->toDateString();
                        $customerhistory->billno = "C" . $order_id;
                        $customerhistory->amount = $balan;
                        $customerhistory->balance = $customerr->amount;
                        $customerhistory->save();

                        $user_amount = User::find(auth()->user()->id);
                        $user_amount->consumer_credit = $user_amount->consumer_credit + $order_details->amount;
                        $user_amount->bill_count = $user_amount->bill_count + 1;

                        $user_amount->save();

                        Cart::where('user_id', auth()->user()->id)->delete();

                        $products = Product::all();
                        $order_details = Order_detail::where('order_id', $order_id)->get();
                        $orderedBy = Order::where('id', $order_id)->get();

                        return view('orders.index', ['products' => $products, 'order_details' => $order_details, 'customer_orders' => $orderedBy]);
                    });
                    // return "Order Failed to inserted check your inputs";
                    return back()->with('success', 'Order Successfully inserted');
                } else if ($request->balance > 0) {
                    return back()->with('error', 'Why Enter Customer. Customer already paid ful amount');
                } else {

                    // return $request->all();
                    \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
                        //Order model
                        $orders = new Order;
                        $orders->name = $request->customer_name;
                        $orders->phone = $request->customer_phone;
                        $orders->save();
                        $order_id =   $orders->id;

                        //order detail modeal
                        $transac = 0;
                        for ($product_id = 0; $product_id < count($request->product_id); $product_id++) {
                            $order_details = new Order_detail;
                            $order_details->order_id = $order_id;
                            $order_details->product_id = $request->product_id[$product_id];
                            $order_details->quantity = $request->quantity[$product_id];
                            $order_details->unitprice = $request->price[$product_id];
                            $order_details->orginal_price = $request->orginal_price[$product_id];
                            $order_details->amount = $request->total_amount[$product_id];
                            $order_details->userid = auth()->user()->id;
                            $order_details->save();
                            $transac = $transac + $request->total_amount[$product_id];



                            $product_details = Product::find($request->product_id[$product_id]);
                            $product_details->quantity = $product_details->quantity - $request->quantity[$product_id];
                            $product_details->save();
                            $qty = $request->quantity[$product_id];


                            $grnproducts = addstoredetails::where('product_id', $request->product_id[$product_id])->get();

                            if ($grnproducts) {
                                foreach ($grnproducts as $grnproduct) {
                                    $qty;
                                    if ($grnproduct->stock_quantity == '0') {
                                        continue;
                                    } else {
                                        if ($grnproduct->stock_quantity < $qty) {
                                            $abc = $qty - $grnproduct->stock_quantity;
                                            $qty = $abc;

                                             // proft Table 
                                             $profit = new profitdetails;
                                             $profit->order_id = $order_id;
                                             $profit->product_id = $request->product_id[$product_id];
                                             $profit->addstoredetail_id = $grnproduct->id;
                                             $profit->quantity = $grnproduct->stock_quantity;
                                             $profit->profit = $request->price[$product_id] - $grnproduct->unitprice;
                                             $profit->date = now()->toDateString();
                                             $profit->user_id = auth()->user()->id;
                                             $profit->save();



                                            $grnproduct->stock_quantity = 0;
                                            $grnproduct->save();
                                        } else {

                                            // proft Table
                                            $profit = new profitdetails;
                                            $profit->order_id = $order_id;
                                            $profit->product_id = $request->product_id[$product_id];
                                            $profit->addstoredetail_id = $grnproduct->id;
                                            $profit->quantity = $qty;
                                            $profit->profit = $request->price[$product_id] - $grnproduct->unitprice;
                                            $profit->date = now()->toDateString();
                                            $profit->user_id = auth()->user()->id;
                                            $profit->save();

                                            
                                            $grnproduct->stock_quantity = $grnproduct->stock_quantity - $qty;
                                            $grnproduct->save();
                                            break;
                                        }
                                    }
                                }
                            } else {
                                // Handle the case where no matching records are found
                                return response()->json(['error' => 'No stock details found for product ID: ' . $request->product_id[$product_id]]);
                            }
                        }


                        //transaction modal
                        $transactions = new Transaction;
                        $transactions->order_id = $order_id;
                        $transactions->user_id = auth()->user()->id;
                        $transactions->balance = $request->balance;
                        $transactions->paid_amount = $request->paid_amount;
                        // $transactions->payment_method = $request->input_method;
                        $transactions->transac_amount = $transac;
                        $transactions->transac_date = now()->toDateString();
                        $transactions->cash = $request->cash - $request->balance;
                        $transactions->bank = $request->bank;
                        $transactions->credit_card = $request->credit_card;
                        $transactions->consumer_credit = $request->balance * -1;
                        $transactions->save();
                        $balan = $request->balance;

                        $customid = customer::where('phone', $request->customer_phone)->first('id');

                        $customerr = customer::find($customid->id);
                        $customerr->amount = $customerr->amount - $balan;
                        $customerr->update();

                        $customerhistory = new customerhistory;
                        $customerhistory->customer_id = $customid->id;
                        $customerhistory->date = now()->toDateString();
                        $customerhistory->billno = "C" . $order_id;
                        $customerhistory->amount = $balan;
                        $customerhistory->balance = $customerr->amount;
                        $customerhistory->save();

                        $user_amount = User::find(auth()->user()->id);
                        $user_amount->cash = $user_amount->cash + $request->cash - $request->balance;
                        $user_amount->bank = $user_amount->bank + $request->bank;
                        $user_amount->card = $user_amount->card + $request->credit_card;
                        $user_amount->consumer_credit = $user_amount->consumer_credit - $balan;
                        $user_amount->bill_count = $user_amount->bill_count + 1;
                        $user_amount->save();


                        Cart::where('user_id', auth()->user()->id)->delete();

                        $products = Product::all();
                        $order_details = Order_detail::where('order_id', $order_id)->get();
                        $orderedBy = Order::where('id', $order_id)->get();

                        return view('orders.index', ['products' => $products, 'order_details' => $order_details, 'customer_orders' => $orderedBy]);
                    });
                    return back()->with('success', 'Order Successfully inserted a');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    public function checkCustomerPhone(Request $request)
    {
        $phone = $request->input('phone');

        $customers = Customer::where('phone', 'LIKE', "%{$phone}%")->get(['id', 'phone']);

        return response()->json(['customers' => $customers]);
        return Customer::select('phone')->get()->toArray();
    }
}
