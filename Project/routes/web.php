<?php

use App\Http\Controllers\AddstoreController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeleteOrderController;
use App\Http\Controllers\HoldOrderController;
use App\Http\Controllers\PayinoutController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CustomerhistoryController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::middleware(['auth', 'user-access:loguser'])->group(function () {
    Route::get('/userstatus/{id}', [App\Http\Controllers\UserController::class, 'userstatus']); //user index
    Route::resource('/user', UserController::class);
    Route::resource('/Order', OrderController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/customer', CustomerController::class);
    Route::get('/barcode', [ProductController::class, 'GetProductBarcodes'])->name('products.barcode');
    Route::resource('/profile', ProfileController::class);
    Route::get('/changepassword', [ProfileController::class, 'changepassword'])->name('changepassword');
    Route::post('changed-password', [ProfileController::class, 'changePass'])->name('password.update');
    Route::resource('/category', CategoryController::class);
    Route::post('/password/update', [ProfileController::class, 'update'])->name('password.update');
    Route::resource('/payinout', PayinoutController::class);
    Route::resource('/payout', PayoutController::class);
    Route::resource('/delorder', DeleteOrderController::class);
    Route::resource('/holdorder', HoldOrderController::class);
    // Route::get('/company-details',[CompaniesController::class, 'index'])->name('company');
    Route::resource('/company', CompaniesController::class);
    // Route::post('/company/update',[CompaniesController::class, 'update'])->name('company.update');
    Route::get('/daily-report', function () {
        return view('reports.DailyReport');
    });
    Route::resource('addproductstore', AddstoreController::class);
    Route::get('/grnview', [AddstoreController::class, 'grnview'])->name('grnview');

    Route::get('/addstore', [ProductController::class, 'addstore'])->name('addstore');
    Route::post('/addstoreupdate/{id}', [ProductController::class, 'addstoreupdate'])->name('addstoreupdate');
    Route::post('/addstoreupdateform', [ProductController::class, 'addstoreupdateform'])->name('addstoreupdateform');
    Route::resource('/paycustomer', CustomerhistoryController::class);
});

Route::resource('/report', ReportController::class);
Route::get('/deleteorder', [ReportController::class, 'deleteorder'])->name('deleteorder');
Route::get('/payinoutreport', [ReportController::class, 'payinoutreport'])->name('payinoutreport');
Route::get('/dayprofit', [ReportController::class, 'dayprofit'])->name('dayprofit');
Route::get('/userprofit', [ReportController::class, 'userprofit'])->name('userprofit');
Route::get('/dalilyreport', [ReportController::class, 'dalilyreport'])->name('dalilyreport');
Route::get('/productquantity', [ReportController::class, 'productquantity'])->name('productquantity');
Route::get('/GRNReportView', [ReportController::class, 'GRNReportView'])->name('GRNReportView');
Route::get('/CustomerReportView', [ReportController::class, 'CustomerReportView'])->name('CustomerReportView');
Route::get('/SaleReportView', [ReportController::class, 'SaleReportView'])->name('SaleReportView');
Route::get('/BillReportView', [ReportController::class, 'BillReportView'])->name('BillReportView');
Route::get('/DeleteitemReportView', [ReportController::class, 'DeleteitemReportView'])->name('DeleteitemReportView');





Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/cashire/home', [App\Http\Controllers\HomeController::class, 'cashireHome'])->name('home');
});
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::resource('/permission', PermissionController::class);
    Route::get('/permissonupdate/{id}', [App\Http\Controllers\PermissionController::class, 'update']);
});
