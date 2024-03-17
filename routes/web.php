<?php

use App\Http\Controllers\AjaxCustomer;
use App\Http\Controllers\AjaxUser;
use App\Http\Controllers\AmountUserController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CapitalBalanceController;
use App\Http\Controllers\CreditsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\LoanPaymentController;
use App\Http\Controllers\PersonalInformationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [homeController::class, 'index'])->name('home.index');

Route::get('/clientes', [CustomerController::class, 'index'])->name('cliente.index');
Route::get('/cliente/{customer}/detalles', [CustomerController::class, 'show'])->name('cliente.show');
Route::get('/cliente/crear', [CustomerController::class, 'create'])->name('cliente.create');
Route::get('/cliente/{customer}/editar', [CustomerController::class, 'edit'])->name('cliente.edit');
Route::post('/cliente', [CustomerController::class, 'store'])->name('cliente.save');
Route::put('/cliente/{customer}', [CustomerController::class, 'update'])->name('cliente.update');
Route::get('/cliente/asignarcobrador', [CustomerController::class, 'assignCredit'])->name('cliente.asignar');
Route::post('/asigarcobrador', [CustomerController::class, 'saveCobrador'])->name('cliente.saveCobrador');
Route::delete('/cliente/{customer}', [CustomerController::class, 'delete'])->name('cliente.delete');

//route credit
Route::get('/prestamos', [CreditsController::class, 'index'])->name('credit.index');
Route::get('/prestamos/crear', [CreditsController::class, 'create'])->name('credit.create');
Route::get('/prestamos/{credit}/edit', [CreditsController::class, 'edit'])->name('credit.edit');
Route::get('/prestamos/reportes', [CreditsController::class, 'report'])->name('credit.report');
Route::get('/prestamos/reportespdf', [CreditsController::class, 'pdfReportCredit'])->name('credit.pdfreportcredit');
Route::get('/prestamos/reportesprestamosvencidos', [CreditsController::class, 'pdfReportCreditDefeated'])->name('credit.pdfreportcreditdefeated');
Route::post('/prestamos', [CreditsController::class, 'save'])->name('credit.save');
Route::put('/prestamos/{credit}', [CreditsController::class, 'update'])->name('credit.update');
Route::delete('/prestamos/{credit}', [CreditsController::class, 'delete'])->name('credit.delete');

//route loanpayment
Route::get('/cobros', [LoanPaymentController::class, 'index'])->name('loanpayment.index');
Route::get('/cobros/nuevo', [LoanPaymentController::class, 'create'])->name('loanpayment.create');
Route::post('/cobro', [LoanPaymentController::class, 'save'])->name('loanpayment.save');

//route AmountUser
Route::get('/listacierres', [AmountUserController::class, 'index'])->name('amounuser.index');
Route::get('/entregarmonto/{amountuser}', [AmountUserController::class, 'confirmcollection'])->name('amountuser.confirm');
Route::get('/reportes', [AmountUserController::class, 'report'])->name('amountuser.report');
Route::get('/reportes/{amountuser}/detalles', [AmountUserController::class, 'reportdetail'])->name('amountuser.reportdetail');
Route::get('/reportes/totalcierres', [AmountUserController::class, 'totalclose'])->name('amountuser.totalclose');
Route::get('/reportes/totalrecaudado/{date}', [AmountUserController::class, 'showtotalclose'])->name('amountuser.showtotalclose');
Route::post('/inicarcobros', [AmountUserController::class, 'startPay'])->name('amountuser.startPay');
Route::post('/cobrocerrar', [AmountUserController::class, 'saveClose'])->name('amountuser.saveClose');
Route::put('/amountuser/{amountuser}', [AmountUserController::class, 'saveConfirmCollection'])->name('amountuser.saveConfirmCollection');

//user
Route::get('/empleados', [PersonalInformationController::class, 'index'])->name('user.index');
Route::get('/empleado/crear', [PersonalInformationController::class, 'create'])->name('user.create');
Route::get('/empleado/{user}/edit', [PersonalInformationController::class, 'edit'])->name('user.edit');
Route::post('/empleado', [PersonalInformationController::class, 'store'])->name('user.save');
Route::put('/empleado/{user}', [PersonalInformationController::class, 'update'])->name('user.update');
Route::delete('/empleado/{user}', [PersonalInformationController::class, 'destroy'])->name('user.destroy');

//capital
Route::get('saldoinicial/', [CapitalBalanceController::class, 'initialBalance'])->name('capitalbalance.initialBalance');
Route::post('saldoinicial/', [CapitalBalanceController::class, 'saveInitialBalance'])->name('capitalbalance.saveInitialBalance');

//gastos
Route::get('/gastos', [BillController::class, 'index'])->name('bill.index');
Route::get('/gastos/crear', [BillController::class, 'create'])->name('bill.create');
Route::get('/gastos/{bill}/ver', [BillController::class, 'show'])->name('bill.show');
Route::get('/gastos/{bill}/edit', [BillController::class, 'edit'])->name('bill.edit');
Route::post('/gastos/crear', [BillController::class, 'store'])->name('bill.store');
Route::put('/gastos/{bill}', [BillController::class, 'update'])->name('bill.update');
Route::delete('/gastos/{bill}', [BillController::class, 'destroy'])->name('bill.destroy');

//ajax
Route::post('/customerid', [AjaxCustomer::class, 'get'])->name('ajaxcustomer.get');
Route::post('/datocredit', [AjaxCustomer::class, 'datoCredit'])->name('ajaxcustomer.datocredit');
Route::post('/userid', [AjaxUser::class, 'getUser'])->name('ajaxuser.get');
