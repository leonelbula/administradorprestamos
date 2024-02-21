<?php

use App\Http\Controllers\AjaxCustomer;
use App\Http\Controllers\CreditsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanPaymentController;
use App\Http\Controllers\PersonalInformationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/clientes', [CustomerController::class, 'index'])->name('cliente.listar');
Route::get('/cliente/{customer}/detalles', [CustomerController::class, 'show'])->name('cliente.show');
Route::get('/cliente/crear', [CustomerController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [CustomerController::class, 'store'])->name('cliente.save');
Route::get('/cliente/{customer}/editar', [CustomerController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/{customer}', [CustomerController::class, 'update'])->name('cliente.update');

//route credit
Route::get('/prestamos', [CreditsController::class, 'index'])->name('credit.listar');
Route::get('/prestamos/crear', [CreditsController::class, 'create'])->name('credit.create');
Route::post('/prestamos', [CreditsController::class, 'save'])->name('credit.save');
Route::get('/prestamos/{credit}/edit', [CreditsController::class, 'edit'])->name('credit.edit');
Route::put('/prestamos/{credit}', [CreditsController::class, 'update'])->name('credit.update');
Route::delete('/prestamos/{credit}', [CreditsController::class, 'delete'])->name('credit.delete');

//route loanpayment
Route::get('/cobros', [LoanPaymentController::class, 'index'])->name('loanpayment.index');

//user
Route::get('/empleados', [PersonalInformationController::class, 'index'])->name('user.listar');
Route::get('/empleado/crear', [PersonalInformationController::class, 'create'])->name('user.create');

//ajax
Route::post('/customerid', [AjaxCustomer::class, 'get'])->name('ajaxcustomer.get');
