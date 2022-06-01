<?php

use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\Auth\LoginController;
Use App\Http\Controllers\admin\UserController;
Use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\frontend\PaymentFlowController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//管理画面
Route::group(['prefix' => 'admin'], function () {

    // Auth
    Route::get('login', [LoginController::class, 'getLoginAdmin'])->name('admin.login');
    Route::post('login',[LoginController::class,'postLogin']);

    Route::any('logout',function (){
        Auth::logout();
        return redirect(route('admin.login'));
    })->name('admin.logout');

    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('bill', [BillController::class, 'index'])->name('admin.home');
        Route::post('bill/delete', [BillController::class, 'delete'])->name('admin.bill.delete');
        Route::post('bill/bulk_delete', [BillController::class, 'bulkDelete'])->name('admin.bill.bulk_delete');
        Route::get('pdf/{file_name?}', [BillController::class, 'showPdf'])->name('admin.file');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('store', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::post('update/{id}', [UserController::class, 'update'])->name('admin.user.update');
            Route::post('delete',[UserController::class,'delete'])->name('admin.user.delete');
        });
        Route::get('customer/create', [BillController::class, 'create'])->name('admin.customer_register');
        Route::post('/customer/confirm', [BillController::class, 'confirm'])->name('admin.customer_register.confirm');
        Route::get('/customer/confirm/{sessionId?}', [BillController::class, 'showConfirm'])->name('admin.customer_register.show_confirm');
        Route::post('customer/store', [BillController::class, 'store'])->name('admin.customer_register.store');
        Route::get('customer/edit/{id}', [BillController::class, 'edit'])->name('admin.bill.edit');
        Route::post('customer/edit/{id}', [BillController::class, 'edit_store'])->name('admin.customer_register.edit_store');
        Route::post('customer/edit', [BillController::class, 'edit_store'])->name('admin.bill.edit.test');
    });
});

//paygentの処理
Route::get('/paygent/{id}', [App\Http\Controllers\PaygentController::class, 'index'])->name('paygent');
Route::post('/paygent/payment_recv', [App\Http\Controllers\PaygentController::class, 'payment_recv'])->name('payment_recv');


//エンドユーザー
Route::get('/', [FrontendHomeController::class, 'index'])->name('frontend.index');
Route::get('input', [PaymentFlowController::class, 'index'])->name('frontend.payment.input');
Route::post('input', [PaymentFlowController::class, 'check'])->name('frontend.payment.check');
Route::get('conf', [PaymentFlowController::class, 'conf'])->name('frontend.payment.conf');
Route::get('conf2', [PaymentFlowController::class, 'conf2'])->name('frontend.payment.conf2');
Route::get('conf3', [PaymentFlowController::class, 'conf3'])->name('frontend.payment.conf3');
Route::get('tokusyohou', [PaymentFlowController::class, 'tokusyohou'])->name('frontend.payment.tokusyohou');
Route::get('completed', [PaymentFlowController::class, 'completed'])->name('frontend.payment.completed');
Route::get('casherror', [PaymentFlowController::class, 'cash_error'])->name('frontend.payment.cash_error');
Route::get('systemerror', [PaymentFlowController::class, 'system_error'])->name('frontend.payment.system_error');

Route::get('pdf/{file_name?}', [PaymentFlowController::class, 'showPDF'])->name('show.pdf');
Route::post('pdf/upload', [BillController::class, 'uploadPdf'])->name('upload_pdf');
