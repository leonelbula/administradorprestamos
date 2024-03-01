@extends('layouts.app')
@section('title')
    {{ $title }} <span> {{ date('Y-m-d') }}</span>
@endsection
<?php date_default_timezone_set('America/Bogota'); ?>
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('loanpayment.index') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">cobros</span>
            </a>
            <a href="#" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Reportes</span>
            </a>
        </div>

        <div class="p-2">
            <div class="row">
                @foreach ($amountsUser as $amount)
                    <div class="col-lg-4 mb-4">
                        <div class="card-body">
                            {{ $amount->user->name }}
                            <div class="text-black-50 p-2">Efectivo A Entregar <br>{{ number_format($amount->amount) }}
                            </div>
                            <div class="text-black-50 p-2">Saldo sin entregar
                                <br>
                                @if ($amount->amount_difference < 0)
                                    <spam class="text-danger">{{ number_format($amount->amount_difference) }}</spam>
                                @else
                                    <spam class="text-success">{{ number_format($amount->amount_difference) }}</spam>
                                @endif

                            </div>
                            @if ($amount->state == 2)
                                <a href="{{ route('amountuser.confirm', $amount->user_id) }}"
                                    class="btn btn-warning btn-sm btn-icon-split">
                                    <span class="text" id="btn-confirmcollection" data-userid="{{ $amount->user_id }}">Ver
                                        detalles</span>
                                </a>
                            @else
                                <a href="{{ route('amountuser.confirm', $amount->user_id) }}"
                                    class="btn btn-success btn-sm btn-icon-split">
                                    <span class="text" id="btn-confirmcollection"
                                        data-userid="{{ $amount->user_id }}">Confirmar</span>
                                </a>
                            @endif

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/amountUser.js') }}"></script>
@endsection
