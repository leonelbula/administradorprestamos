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
            <a href="{{ route('amounuser.index') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Total Ingresado</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Diferencia</th>

                            <th>Aciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($totalValue as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $value->date }}</td>
                                <td>{{ number_format($value->total, 0, '', '.') }}</td>
                                <td>{{ number_format($value->total_difference, 0, '', '.') }}</td>

                                <td>
                                    <a href="{{ route('amountuser.showtotalclose', $value->date) }}"
                                        class="btn btn-info btn-sm">
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
