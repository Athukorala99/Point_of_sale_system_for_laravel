<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Companies;
use App\Models\Order;
use App\Models\customer;
use App\Models\Order_detail;
use App\Models\transaction;
use Illuminate\Http\Request;
use picqer;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Modify the query to filter products if search is provided
        $products = Product::when($search, function ($queryBuilder) use ($search) {
            // Trim search input to avoid leading/trailing spaces
            $search = trim($search);
            return $queryBuilder->where('product_name', 'like', '%' . $search . '%');
        })->paginate(5); // Keeps pagination and limits to 5 per page

        // Fetch categories and suppliers
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Check user permissions before showing products
        if (auth()->user()->product_view == 1) {
            return view('products.index', [
                'products' => $products,
                'categories' => $categories,
                'suppliers' => $suppliers,
                'search' => $search, // Pass search query back to the view
                
            ]);
        } else {
            return response()->json(['You do not have permission to access this page.']);
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
        $countbarcode = Product::where('barcode', $request->barcode)->count();
        if ($countbarcode > 0) {
            return redirect()->back()->with('error', 'Barcode Already Exists');
        }
        $products = Product::create($request->all());
        if ($products) {
            return redirect()->back()->with('success', 'Product Add Successfully');
        } else {
            return redirect()->back()->with('error', 'Product Add Failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product)
    {
        if ($request->editprice != '1') {
            $editprice = 0;
        } else {
            $editprice = 1;
        }

        // Product::create($request->all());
        $product = Product::find($product);
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        // $product->product_code = $product_code;
        $product->category = $request->category;
        $product->barcode = $request->barcode;
        $product->supplier = $request->supplier;
        $product->print_name = $request->print_name;
        $product->alert_stock = $request->alert_stock;
        $product->editprice = $editprice;

        $product->save();

        if (!$product) {
            return back()->with('error', 'Product not found');
        }
        $product->update($request->all());


        return redirect()->back()->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!$product) {
            return back()->with('error', 'Product not found');
        }
        $product->delete();

        return back()->with('success', 'Product Delete Successfully');
    }
    public  function addstore(Request $request)
    {
        $products = Product::paginate(5);
        // $products = Product::all();

        $categories = Category::all();
        $suppliers = Supplier::all();
        $orders = Order::all();
        $lastID = Transaction::where('user_id', auth()->user()->id)->max('order_id');

        $order_recept = Order_detail::where('order_id', $lastID)->get();
        $transactionsdate = Transaction::where('order_id', $lastID)->value('created_at');
        $paidcash = Transaction::where('order_id', $lastID)->value('paid_amount');
        $customer = customer::all();
        $companies = Companies::all();
        if (auth()->user()->addstore_view == 1) {

            return view('products.addstore', ['suppliers' => $suppliers, 'categories' => $categories, 'customer' => $customer, 'products' => $products, 'orders' => $orders, 'order_recept' => $order_recept, 'transactionsdate' => $transactionsdate, 'paidcash' => $paidcash, 'lastID' => $lastID, 'companies' => $companies]);
        } else {
            return response()->json(['You do not have permission to access for this page.']);
        }
    }
    public function addstoreupdate(Request $request, $product)
    {
        // Retrieve the product by barcode
        $selctproduct = Product::where('barcode', $request->barcode)->first();

        // Check if product exists
        if ($selctproduct) {
            // Add the new quantity to the existing quantity
            $selctproduct->quantity = number_format($request->quantity, 2) + $selctproduct->quantity;
            $selctproduct->save(); // Use save() to update the model
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }

        return redirect()->back()->with('success', 'Product Updated Successfully');
    }
    public function addstoreupdateform(Request $request)
    {
        // return $request->all();
        // Retrieve the product by barcode
        $selctproduct = Product::where('barcode', $request->barcode)->first();

        // Check if product exists
        if ($selctproduct) {
            // Add the new quantity to the existing quantity
            $selctproduct->quantity = number_format($request->quantity, 2) + $selctproduct->quantity;
            $selctproduct->save(); // Use save() to update the model
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }

        return redirect()->back()->with('success', 'Product Updated Successfully');
    }
}
