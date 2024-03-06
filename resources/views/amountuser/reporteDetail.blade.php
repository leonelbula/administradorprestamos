@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('amountuser.report') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Volver</span>
            </a>
        </div>
        <div class="card-body">
            <div class="col-lg-9">
                <div class="p-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ strtoupper($amountuser->user->name) }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <ul>
                        <li>{{ $amountuser->user->type }}</li>
                        <li>{{ $amountuser->user->email }}</li>
                        <li></li>
                    </ul>
                    <hr>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Observacion</h6>
                    </div>
                    <ul>
                        <li>{{ $amountuser->details }}</li>
                    </ul>
                    <hr>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informacion</h6>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>codigo</th>
                                    <th>Valor</th>
                                    <th>Saldo</th>
                                    <th>Fecha</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{ $amountuser->id }}</td>
                                    <td>{{ $amountuser->amount }}</td>
                                    <td>
                                    @if ($amountuser->amount_difference < 0)
                                        <spam class="text-danger">
                                            {{ number_format($amountuser->amount_difference, 0, '', '.') }}</spam>
                                    @else
                                        <spam class="text-success">{{ number_format($amountuser->amount_difference,0, '', '.') }}</spam>
                                    @endif
                                   
                                    <td>{{ $amountuser->date }}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
