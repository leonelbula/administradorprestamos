@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
<?php date_default_timezone_set('America/Bogota'); ?>
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('loanpayment.index') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Cancelar</span>
            </a>
            <a href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#customerModal">
                <span class="text">Agregar Cliente</span>
            </a>
        </div>
        <div class="card-body">
            <div class="col-lg-7">
                <div class="p-2">
                    <form class="user" method="POST" action="{{ route('loanpayment.save') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control " name="fullname" id="fullname"
                                value="{{ old('fullname') }}" placeholder="Nombre Cliente" disabled>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="creditid" id="creditid" value="">


                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Cuotas a pagar</label>
                                <input type="number" class="form-control " name="" id="valpay" value=""
                                    placeholder="Valor de cuota" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Cuotas Pendiente</label>
                                <input type="number" class="form-control " name="" id="numcouta" value=""
                                    placeholder="Cuotas pendiente" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="">Cuotas recibida</label>
                                <input type="number" class="form-control " name="amount" id="amount"
                                    value="{{ old('amount') }}" placeholder="Valor Abonado">
                            </div>
                            <div class="col-sm-6">
                                <label for="">Fecha</label>
                                <input type="date" class="form-control " name="date" id="date"
                                    value="{{ date('Y-m-d') }}" placeholder="">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" id="Save">Guardar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="customercredit" value="{{ route('ajaxcustomer.datocredit') }}">
@endsection

<div class="modal fade tableCustomer" id="customerModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lista de clientes</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Barrio</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->fullname }}</td>
                                <td>{{ $customer->direction }}</td>
                                <td>
                                    <button class="btn btn-success agregarCliente recuperarBoton" type="button"
                                        id="customer_id" data-id="{{ $customer->id }}">Agregar</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@section('script')
    @if (session('fail'))
        <script>
            Swal.fire({
                title: 'Error',
                text: '{{ session('fail') }}',
                icon: 'error',
                confirmButtonText: 'Cerrar'
            })
        </script>
    @elseif (session('success'))
        <script>
            Swal.fire({
                title: 'Informacion guardada',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Cerrar'
            })
        </script>
    @endif
    <script src=""></script>
    <script src="{{ asset('js/customeloanpay.js') }}"></script>
@endsection
