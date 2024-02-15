<?php

use App\Http\Controllers\CreditsController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', [CustomerController::class, 'index'])->name('cliente.listar');
Route::get('/cliente/{customer}/detalles', [CustomerController::class, 'show'])->name('cliente.show');
Route::get('/cliente/crear', [CustomerController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [CustomerController::class, 'store'])->name('cliente.save');
Route::get('/cliente/{customer}/editar', [CustomerController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/{customer}', [CustomerController::class, 'update'])->name('cliente.update');

//route credit
Route::get('/prestamos', [CreditsController::class, 'index'])->name('credit.listar');
