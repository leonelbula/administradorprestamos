<?php

use App\Http\Controllers\AjaxCustomer;
use App\Http\Controllers\AjaxUser;
use App\Http\Controllers\AmountUserController;
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
Route::get('/cliente/asignarcobrador', [CustomerController::class, 'assigncredit'])->name('cliente.asignar');
Route::post('/asigarcobrador', [CustomerController::class, 'savecobrador'])->name('cliente.savecobrador');

//route credit
Route::get('/prestamos', [CreditsController::class, 'index'])->name('credit.index');
Route::get('/prestamos/crear', [CreditsController::class, 'create'])->name('credit.create');
Route::get('/prestamos/{credit}/edit', [CreditsController::class, 'edit'])->name('credit.edit');
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
Route::post('/inicarcobros', [AmountUserController::class, 'start_pay'])->name('amountuser.start_pay');
Route::post('/cobrocerrar', [AmountUserController::class, 'saveclose'])->name('amountuser.saveclose');
Route::put('/amountuser/{amountuser}', [AmountUserController::class, 'saveconfirmcollection'])->name('amountuser.saveconfirmcollection');

//user
Route::get('/empleados', [PersonalInformationController::class, 'index'])->name('user.index');
Route::get('/empleado/crear', [PersonalInformationController::class, 'create'])->name('user.create');
Route::post('/empleado', [PersonalInformationController::class, 'save'])->name('user.save');

//ajax
Route::post('/customerid', [AjaxCustomer::class, 'get'])->name('ajaxcustomer.get');
Route::post('/datocredit', [AjaxCustomer::class, 'datoCredit'])->name('ajaxcustomer.datocredit');
Route::post('/userid', [AjaxUser::class, 'getUser'])->name('ajaxuser.get');
