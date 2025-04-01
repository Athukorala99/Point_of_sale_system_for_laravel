<?php

namespace App\Http\Controllers;

use App\Models\addstore;
use App\Models\delete_order;
use App\Models\delete_order_details;
use App\Models\payinout;
use Illuminate\Http\Request;
use App\Models\profitdetails;
use App\Models\Product;
use App\Models\category;
use App\Models\addstoredetails;
use App\Models\customer;
use App\Models\Deleteitem;
use App\Models\Order_detail;
use App\Models\transaction;
use Carbon\Carbon;


class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function deleteorder(Request $request)
    {
        $sdate = $request->sdate;
        $edate = $request->edate;
        $delorders = delete_order::all();
        $delorderdetails = delete_order_details::all();

        return view('reports.DeleteReportview', ['delorders' => $delorders, 'delorderdetails' => $delorderdetails, 'sdate' => $sdate, 'edate' => $edate]);
    }

    public function payinoutreport(Request $request)
    {
        $payinouts = payinout::all();
        $sdate = $request->sdate;
        $edate = $request->edate;

        return view('reports.PayinoutReportview', ['payinouts' => $payinouts, 'sdate' => $sdate, 'edate' => $edate]);
    }


    public function dayprofit(Request $request)
    {
        $sdate = $request->sdate;
        $edate = $request->edate;

        $profitdetails = profitdetails::whereDate('created_at', '>=', $sdate)
            ->whereDate('created_at', '<=', $edate)
            ->selectRaw('DATE(date) as date, SUM(profit * quantity) as total_profit, SUM(quantity) as total_quantity, COUNT(DISTINCT order_id) as billcount')
            ->groupBy('date')
            ->get();

        return view('reports.ProfitdayReportview', [
            'profitdetails' => $profitdetails,
            'sdate' => $sdate,
            'edate' => $edate,
        ]);
    }

    public function userprofit(Request $request)
    {
        $sdate = $request->sdate;
        $edate = $request->edate;

        $profitdetails = profitdetails::whereDate('created_at', '>=', $sdate)
            ->whereDate('created_at', '<=', $edate)
            ->selectRaw('user_id, SUM(profit * quantity) as total_profit, SUM(quantity) as total_quantity, COUNT(DISTINCT order_id) as billcount')
            ->groupBy('user_id')
            ->with('user') // Assuming there's a relationship defined with the User model
            ->get();

        return view('reports.ProfituserReportview', [
            'profitdetails' => $profitdetails,
            'sdate' => $sdate,
            'edate' => $edate,
        ]);
    }


    public function productquantity(Request $request){
       
        $products = Product::all();
        $category=category::all();
        return view('reports.ProductquantityReportview', ['products' => $products, 'category' => $category]);
    }

    public function GRNReportView(Request $request){
        $sdate = $request->sdate;
        $edate = $request->edate;

        $order_recept = addstore::all();
        $order_recept_details = addstoredetails::all();
        
        return view('reports.GRNReportview', ['sdate' => $sdate, 'edate' => $edate, 'order_recept' => $order_recept, 'order_recept_details' => $order_recept_details]);
    }

    public function CustomerReportView(Request $request){
       
       

        $customers = customer::all();
        return view('reports.CustomerReportView', ['customers' => $customers]);
    }

    public function SaleReportView(Request $request){
        $sdate = $request->sdate;
        $edate = $request->edate;

        $Saledetails = Order_detail::whereDate('created_at', '>=', $sdate)
            ->whereDate('created_at', '<=', $edate)
            ->selectRaw(' product_id, SUM(amount) as total_amount, SUM(quantity) as total_quantity, COUNT(DISTINCT order_id) as billcount')
            ->groupBy('product_id')
            ->get();

        return view('reports.salesReportview', [
            'profitdetails' => $Saledetails,
            'sdate' => $sdate,
            'edate' => $edate,
        ]);
    }

    public function BillReportView(Request $request){
        $transactions = transaction::all();
        $sdate = $request->sdate;
        $edate = $request->edate;


        return view('reports.BillReportView', ['transactions' => $transactions, 'sdate' => $sdate, 'edate' => $edate]);
    }

    public function DeleteitemReportView(Request $request){
        $deleteitems = Deleteitem::all();
        $sdate = $request->sdate;
        $edate = $request->edate;


        return view('reports.DeleteitemReportView', ['deleteitems' => $deleteitems, 'sdate' => $sdate, 'edate' => $edate]);
    }


    public function dalilyreport($id)
    {
       
    }
}
