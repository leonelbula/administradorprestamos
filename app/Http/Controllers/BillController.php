<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Lista de gastos";
        $bills = Bill::orderby('id', 'desc')->get();
        return view('bill.index', compact('title', 'bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Nuevo gasto";
        return view('bill.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'required|string'
        ]);

        $bill = new Bill();
        $bill->date = $request->date;
        $bill->amount = $request->amount;
        $bill->description = $request->description;

        $bill->save();
        return redirect()->route('bill.create')->with('success', 'Gasto registrado corectamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        $title = "Detalles gasto";
        return view('bill.show', compact('title', 'bill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        $title = "Editar gasto";
        return view('bill.edit', compact('title', 'bill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'required|string'
        ]);

        $bill->date = $request->date;
        $bill->amount = $request->amount;
        $bill->description = $request->description;

        $bill->save();
        return redirect()->route('bill.index')->with('success', 'Gasto editado corectamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bill.index')->with('success', 'Gasto eliminado corectamente');
    }
}
