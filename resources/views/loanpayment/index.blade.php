@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('buttom')
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('loanpayment.create') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Nuevo Registro</span>
            </a>

            @if (!isset($state))
                <a href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#initpayModal">
                    <span class="text">Iniciar Cobros</span>
                </a>
            @else
                <a href="#" class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal"
                    data-target="#loanpaycloseModal">
                    <span class="text">Liquidar Cobros</span>
                </a>
            @endif


        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cobros Realizados Total = {{ count($loanPay) }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre cliente</th>
                                        <th>Aciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($customerspays as $pay)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $pay->fullname }}</td>
                                            <td>
                                                <a href="" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Cobros Pendiente Total =
                            @php
                                $saldo = $numPay - count($loanPay);
                            @endphp
                            {{ $saldo }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nombre cliente</th>
                                        <th>Direccion</th>
                                        <th>Aciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customersPend as $customer)
                                        <tr>
                                            <td>{{ $customer->fullname }}</td>
                                            <td>{{ $customer->direction }}</td>
                                            <td>
                                                <a href="" class="btn btn-info btn-sm">
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
            </div>
        </div>


    </div>
@endsection


<div class="modal fade" id="initpayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Iniciar Cobros del dia</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('amountuser.start_pay') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input type="date" class="form-control " name="date" id="date"
                                value="{{ date('Y-m-d') }}" placeholder="">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary" id="btnInit">Iniciar Cobros</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade " id="loanpaycloseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmar Cierre</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" method="POST" action="{{ route('amountuser.saveclose') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control " name="fullname" id="fullname"
                            value="{{ auth()->user()->name }}" placeholder="Nombre de cobrador" disabled>
                        <input type="hidden" name="id" id="id" value="1">

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="date" class="form-control " name="date" id="date"
                                value="{{ date('Y-m-d') }}" placeholder="">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" id="Save">Guardar</button>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@section('script')

    @hasSection('valid')
    <script>
        Swal.fire({
            title: 'Error!',
            text: 'Existen cobros registrado con esta fecha',
            icon: 'error',
            confirmButtonText: 'Cerrar'
        })
    </script>
    @endif
       
   
@endsection
