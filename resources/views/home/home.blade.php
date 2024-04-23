@extends('layouts.app')
@section('title')
    {{ $title }} <span> {{ date('Y-m-d') }}</span>
@endsection
@section('content')
    <div class="card shadow mb-4">
        @isset($fail)
            <tr>
                <div class="card mb-4 py-3 border-bottom-danger">
                    <div class="card-body">
                        {{ $fail }}
                    </div>
                </div>

            </tr>
        @endisset


        <div class="p-2">
            @if (auth()->user()->type == 'admin')
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Clientes</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($customers[0]->total, 0, '', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total prestamos</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($credit[0]->total, 0, '', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Recaudo del dia
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">$</div>
                                            </div>
                                            <div class="col">
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ number_format($amountTotal[0]->total, 0, '', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <a href="{{ route('loanpayment.pendieg') }}">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Recaudos pendientes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ number_format($pendiente, 0, '', '.') }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cobros Realizados</th>
                                        <th>Cobros Pendientes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($fail)
                                        <tr>
                                            <div class="card mb-4 py-3 border-bottom-danger">
                                                <div class="card-body">
                                                    {{ $fail }}
                                                </div>
                                            </div>

                                        </tr>
                                    @endisset
                                    @foreach ($cobrospendienteusuario as $cobros)
                                        <tr>
                                            <td>{{ $cobros->user->name }}</td>
                                            <td>{{ $cobros->asig - $cobros->pendit }}</td>
                                            <td>{{ $cobros->pendit }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="card-body">
                        <hr>
                        <h3>Recaudo por cobrador</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="cobroTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Valor recaudado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($fail)
                                        <tr>
                                            <div class="card mb-4 py-3 border-bottom-danger">
                                                <div class="card-body">
                                                    {{ $fail }}
                                                </div>
                                            </div>

                                        </tr>
                                    @endisset
                                    @foreach ($PaymentTotalUser as $cobros)
                                        <tr>
                                            <td>{{ $cobros->user->name }}</td>
                                            <td>{{ $cobros->total }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Clientes</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($customers[0]->total, 0, '', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total prestamos</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ number_format($credit[0]->total, 0, '', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <a href="{{ route('loanpayment.pendieg') }}">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Recaudos pendientes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ number_format($pendiente, 0, '', '.') }}
                                            </div>
                                        </div>
                                    </a>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/amountUser.js') }}"></script>
@endsection
