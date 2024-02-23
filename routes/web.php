<?php

use App\Http\Controllers\AjaxCustomer;
use App\Http\Controllers\AjaxUser;
use App\Http\Controllers\AmountUserController;
use App\Http\Controllers\CreditsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanPaymentController;
use App\Http\Controllers\PersonalInformationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/clientes', [CustomerController::class, 'index'])->name('cliente.index');
Route::get('/cliente/{customer}/detalles', [CustomerController::class, 'show'])->name('cliente.show');
Route::get('/cliente/crear', [CustomerController::class, 'create'])->name('cliente.create');
Route::get('/cliente/{customer}/editar', [CustomerController::class, 'edit'])->name('cliente.edit');
Route::post('/cliente', [CustomerController::class, 'store'])->name('cliente.save');
Route::put('/cliente/{customer}', [CustomerController::class, 'update'])->name('cliente.update');

//route credit
Route::get('/prestamos', [CreditsController::class, 'index'])->name('credit.index');
Route::get('/prestamos/crear', [CreditsController::class, 'create'])->name('credit.create');
Route::get('/prestamos/{credit}/edit', [CreditsController::class, 'edit'])->name('credit.edit');
Route::get('/prestamos/asignarcobrador', [CreditsController::class, 'assigncredit'])->name('credit.asignar');
Route::post('/prestamos', [CreditsController::class, 'save'])->name('credit.save');
Route::post('/asigarcobrador', [CreditsController::class, 'savecobrador'])->name('credit.savecobrador');
Route::put('/prestamos/{credit}', [CreditsController::class, 'update'])->name('credit.update');
Route::delete('/prestamos/{credit}', [CreditsController::class, 'delete'])->name('credit.delete');

//route loanpayment
Route::get('/cobros', [LoanPaymentController::class, 'index'])->name('loanpayment.index');
Route::get('/cobros/nuevo', [LoanPaymentController::class, 'create'])->name('loanpayment.create');
Route::post('cobro', [LoanPaymentController::class, 'save'])->name('loanpayment.save');

//route AmountUser
Route::get('/listacierres', [AmountUserController::class, 'index'])->name('amounuser.index');
Route::post('/inicarcobros', [AmountUserController::class, 'start_pay'])->name('amountuser.start_pay');

//user
Route::get('/empleados', [PersonalInformationController::class, 'index'])->name('user.index');
Route::get('/empleado/crear', [PersonalInformationController::class, 'create'])->name('user.create');

//ajax
Route::post('/customerid', [AjaxCustomer::class, 'get'])->name('ajaxcustomer.get');
Route::post('/datocredit', [AjaxCustomer::class, 'datoCredit'])->name('ajaxcustomer.datocredit');
Route::post('/userid', [AjaxUser::class, 'getUser'])->name('ajaxuser.get');
