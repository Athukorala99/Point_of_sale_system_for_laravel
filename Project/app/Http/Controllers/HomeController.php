<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\customer;
use Carbon\Carbon;
use App\Models\transaction;
use App\Models\profitdetails;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productcount = product::count();
        $todaySalesCount = transaction::whereDate('transac_date', Carbon::today())->count();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $monthlyEarnings = transaction::select(
            DB::raw('SUM(transac_amount) as total_earnings'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year')
        )
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

            $monthlyProfits = profitdetails::select(
                DB::raw('SUM(profit * quantity) as total_profits'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year')
            )
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

        $countCash = transaction::whereDate('transac_date', Carbon::today())->sum('cash');
        $countBank = transaction::whereDate('transac_date', Carbon::today())->sum('bank');
        $countCredit = transaction::whereDate('transac_date', Carbon::today())->sum('credit_card');
        $countconsumer_credit = transaction::sum('consumer_credit');
        $todayTotalAmount = transaction::whereDate('transac_date', Carbon::today())->sum('transac_amount');
        $lowStockProducts = Product::whereColumn('quantity', '<', 'alert_stock')->get(['product_name', 'price', 'quantity']);
        $customers = customer::all();

        return view('home', ['productcount' => $productcount, 'salesCount' => $todaySalesCount, 'earnings' => $monthlyEarnings, 'cash' => $countCash, 'bank' => $countBank, 'card' => $countCredit, 'countconsumer_credit' => $countconsumer_credit, 'todayTotalAmount' => $todayTotalAmount, 'lowStockProducts' => $lowStockProducts, 'customers' => $customers, 'profits' => $monthlyProfits]);
    }
    public function cashireHome()
    {
        return view('cashire');
    }
}
