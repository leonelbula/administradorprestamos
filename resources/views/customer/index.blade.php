@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('buttom')
    @if (auth()->user()->type == 'admin')
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    @endif
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('cliente.create') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Nuevo cliente</span>
            </a>
            @if (auth()->user()->type == 'admin')
                <a href="{{ route('cliente.asignar') }}" class="btn btn-primary btn-sm btn-icon-split">
                    <span class="text">Asignar Cobrador</span>
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Barrio</th>
                            <th>Telefono</th>
                            <th>Ciudad</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->fullname }}</td>
                                <td>{{ $customer->identification }}</td>
                                <td>{{ $customer->direction }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->city }}</td>
                                <td>
                                    <a href="{{ route('cliente.show', $customer) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('cliente.edit', $customer) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
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
