<?php

namespace App\Http\Controllers;

use App\Models\AssignPayment;
use App\Models\Credits;
use App\Models\Customer;
use App\Models\NewCreditdUser;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CreditsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (auth()->user()->type == 'admin') {
            $credits = Credits::all();
        } else {
            $credits =  AssignPayment::join('credits', 'credits.customer_id', '=', 'assign_payments.customer_id')->where('user_id', auth()->user()->id)->get();
        }


        $title = "lista de Prestamos";
        return view('credit.index', compact('title', 'credits'));
    }
    public function create()
    {
        $customers = Customer::all();
        $title = "Nuevo Prestamo";
        return view('credit.create', compact('title', 'customers'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'quota_number' => 'required',
            'interest' => 'required',
            'date' => 'required',
        ]);


        $amount = str_replace('.', '', $request->amount);

        $utility = $request->total - $amount;
        $date_expiration = date('Y-m-d', strtotime('+' . $request->quota_number . 'day', strtotime($request->date)));

        $credit = new Credits();
        $credit->amount = $amount;
        $credit->utility = $utility;
        $credit->balance = $request->total;
        $credit->quota_number = $request->quota_number;
        $credit->quota_number_pendieng = $request->quota_number;
        $credit->interest = $request->interest;
        $credit->date = $request->date;
        $credit->expiration_date = $date_expiration;
        $credit->status = 1;
        $credit->customer_id = $request->id;

        $credit->save();


        if (auth()->user()->type != 'admin') {
            $newCredit = new NewCreditdUser();
            $newCredit->date = $request->date;
            $newCredit->amount = $amount;
            $newCredit->user_id = auth()->user()->id;
            $newCredit->customer_id = $request->id;
            $newCredit->save();
        }

        return redirect()->route('credit.index')->with('success', 'Credito registrados corectamente');
    }
    public function edit(Credits $credit)
    {
        $title = "Editar Prestamo";
        $customers = Customer::all();
        return view('credit.edit', compact('title', 'credit', 'customers'));
    }
    public function update(Request $request, Credits $credit)
    {
        $request->validate([
            'id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'quota_number' => 'required',
            'date' => 'required',
        ]);

        if ($request->total != $credit->total) {
            $utility = $request->total - $request->amount;
        } else {
            $utility = $credit->utility;
        }


        $date_expiration = date('Y-m-d', strtotime('+' . $request->quota_number . 'day', strtotime($request->date)));

        $credit->amount = $request->amount;
        $credit->utility = $utility;
        $credit->balance = $request->total;
        $credit->quota_number = $request->quota_number;
        $credit->quota_number_pendieng = $request->quota_number;
        $credit->date = $request->date;
        $credit->expiration_date = $date_expiration;
        $credit->status = 1;
        $credit->customer_id = $request->id;


        $credit->save();

        return redirect()->route('credit.index')->with('success', 'Credito actulizado corectamente');
    }
    public function delete(Credits $credit)
    {
        $credit->delete();
        return redirect()->route('credit.index')->with('success', 'Credito eliminado corectamente');
    }
    public function report()
    {
        $title = "Clientes creditos Vencidos";
        if (auth()->user()->type == 'admin') {
            $credist = Credits::all();
        } else {
            $credits =  AssignPayment::join('credits', 'credits.customer_id', '=', 'assign_payments.customer_id')->where('user_id', auth()->user()->id)->get();
        }
        return view('credit.report', compact('title', 'credits'));
    }
    public function pdfReportCredit()
    {

        $data = Credits::where('status', 1)->get();
        $view = view('pdf.pdfreportcredit', compact('data'));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();
        // return $pdf->download('invoice.pdf');
    }
    public function pdfReportCreditDefeated()
    {

        $data = Credits::where('status', 1)->get();
        $view = view('pdf.pdfreportcreditdefeated', compact('data'));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream();
        // return $pdf->download('invoice.pdf');
    }
}
