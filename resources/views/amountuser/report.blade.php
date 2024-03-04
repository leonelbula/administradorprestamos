@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('buttom')
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('amounuser.index') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Volver</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Cobrador</th>
                            <th>Valor</th>
                            <th>Saldo</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listReporte as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->date }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ number_format($value->amount, 0, '', '.') }}</td>
                                <td>{{ number_format($value->amount_difference, 0, '', '.') }}</td>

                                <td>
                                    <a href="{{ route('amountuser.reportdetail', $value) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
