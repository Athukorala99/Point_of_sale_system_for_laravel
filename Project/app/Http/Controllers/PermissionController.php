<?php

namespace App\Http\Controllers;

use App\Models\permission;
use Illuminate\Http\Request;
use App\Models\User;

class PermissionController extends Controller
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
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $permission)
    {
        //  return $request->all();
        $permission = User::find($permission);

        if ($request->home_view != '1') {
            $home_view = 0;
        } else {
            $home_view = 1;
        }


        if ($request->order_view != '1') {
            $order_view = 0;
        } else {
            $order_view = 1;
        }


        if ($request->user_view != '1') {
            $user_view = 0;
        } else {
            $user_view = 1;
        }
        if ($request->user_add != '1') {
            $user_add = 0;
        } else {
            $user_add = 1;
        }
        if ($request->user_edit != '1') {
            $user_edit = 0;
        } else {
            $user_edit = 1;
        }
        if ($request->user_delete != '1') {
            $user_delete = 0;
        } else {
            $user_delete = 1;
        }



        if ($request->product_view != '1') {
            $product_view = 0;
        } else {
            $product_view = 1;
        }
        if ($request->product_add != '1') {
            $product_add = 0;
        } else {
            $product_add = 1;
        }
        if ($request->product_edit != '1') {
            $product_edit = 0;
        } else {
            $product_edit = 1;
        }
        if ($request->product_delete != '1') {
            $product_delete = 0;
        } else {
            $product_delete = 1;
        }



        if ($request->category_view != '1') {
            $category_view = 0;
        } else {
            $category_view = 1;
        }
        if ($request->category_add != '1') {
            $category_add = 0;
        } else {
            $category_add = 1;
        }
        if ($request->category_edit != '1') {
            $category_edit = 0;
        } else {
            $category_edit = 1;
        }
        if ($request->category_delete != '1') {
            $category_delete = 0;
        } else {
            $category_delete = 1;
        }
        if ($request->user_status != '1') {
            $user_status = 0;
        } else {
            $user_status = 1;
        }



        if ($request->supplier_view != '1') {
            $supplier_view = 0;
        } else {
            $supplier_view = 1;
        }
        if ($request->supplier_add != '1') {
            $supplier_add = 0;
        } else {
            $supplier_add = 1;
        }
        if ($request->supplier_edit != '1') {
            $supplier_edit = 0;
        } else {
            $supplier_edit = 1;
        }
        if ($request->supplier_delete != '1') {
            $supplier_delete = 0;
        } else {
            $supplier_delete = 1;
        }



        if ($request->customer_view != '1') {
            $customer_view = 0;
        } else {
            $customer_view = 1;
        }
        if ($request->customer_add != '1') {
            $customer_add = 0;
        } else {
            $customer_add = 1;
        }
        if ($request->customer_edit != '1') {
            $customer_edit = 0;
        } else {
            $customer_edit = 1;
        }
        if ($request->customer_delete != '1') {
            $customer_delete = 0;
        } else {
            $customer_delete = 1;
        }
        if ($request->customer_pay != '1') {
            $customer_pay = 0;
        } else {
            $customer_pay = 1;
        }


        //////////////////////////////////////////////////

        if ($request->payin_out != '1') {
            $payin_out = 0;
        } else {
            $payin_out = 1;
        }
        if ($request->payin != '1') {
            $payin = 0;
        } else {
            $payin = 1;
        }
        if ($request->handmoney != '1') {
            $handmoney = 0;
        } else {
            $handmoney = 1;
        }



        if ($request->addstore_view != '1') {
            $addstore_view = 0;
        } else {
            $addstore_view = 1;
        }
        if ($request->addstore_list != '1') {
            $addstore_list = 0;
        } else {
            $addstore_list = 1;
        }
        if ($request->addstore_bill != '1') {
            $addstore_bill = 0;
        } else {
            $addstore_bill = 1;
        }



        $permission->home_view = $home_view;
        $permission->order_view = $order_view;

        $permission->user_view = $user_view;
        $permission->user_add = $user_add;
        $permission->user_edit = $user_edit;
        $permission->user_delete = $user_delete;
        $permission->user_status = $user_status;

        $permission->product_view = $product_view;
        $permission->product_add = $product_add;
        $permission->product_edit = $product_edit;
        $permission->product_delete = $product_delete;

        $permission->caregory_view = $category_view;
        $permission->caregory_add = $category_add;
        $permission->caregory_edit = $category_edit;
        $permission->caregory_delete = $category_delete;

        $permission->supplier_view = $supplier_view;
        $permission->supplier_add = $supplier_add;
        $permission->supplier_edit = $supplier_edit;
        $permission->supplier_delete = $supplier_delete;

        $permission->customer_view = $customer_view;
        $permission->customer_add = $customer_add;
        $permission->customer_edit = $customer_edit;
        $permission->customer_delete = $customer_delete;
        $permission->customer_pay = $customer_pay;

        $permission->payin_out = $payin_out;
        $permission->payin = $payin;
        $permission->handmoney = $handmoney;

        $permission->addstore_view = $addstore_view;
        $permission->addstore_list = $addstore_list;
        $permission->addstore_bill = $addstore_bill;

        // return response()->json([$home_view, $order_view, $user_view, $user_add, $user_edit, $user_delete, $product_view, $product_add, $product_edit, $product_delete, $category_view, $category_add, $category_edit, $category_delete]);

        $permission->update();

        if (!$permission) {
            return back()->with('error', 'not found');
        }
        return redirect()->back()->with('success', ' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permission $permission)
    {
        //
    }
}
