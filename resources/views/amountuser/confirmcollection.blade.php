@extends('layouts.app')
@section('title')
    {{ $title }} <span> {{ date('Y-m-d') }}</span>
@endsection
<?php date_default_timezone_set('America/Bogota'); ?>
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('amounuser.index') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Recaudos</span>
            </a>
            <a href="#" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Reportes</span>
            </a>
        </div>

        <div class="p-2">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card-body">
                        <form class="user" method="POST"
                            action="{{ route('amountuser.saveConfirmCollection', $amountuser) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <input type="text" class="form-control " name="name" id="fullname"
                                    value="{{ $amountuser->user->name }}" placeholder="Nombre Cobrador" disabled>
                                <input type="hidden" name="id" id="id" value="{{ $amountuser->user->id }}">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Valor a Entregar</label>
                                    <input type="number" class="form-control " name="amount" id="amount"
                                        value="{{ $amountuser->amount }}" placeholder="Valor entregado" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Valor a Entregado</label>
                                    <input type="text" class="form-control " name="deliveredvalue" id="deliveredvalue"
                                        value="{{ old('deliveredvalue') }}" placeholder="Valor entregado">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="diferencia">Diferencia</label>
                                    <input type="number" class="form-control " name="difference" id="difference"
                                        value="" placeholder="Diferencia" disabled>
                                </div>
                                <div class="col-sm-6">
                                    <label for="date">Fecha</label>
                                    <input type="date" class="form-control " name="date" id="date"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <label for="detail">Observaciones</label>
                                    <input type="text" class="form-control " name="details" id="details"></input>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="btnSave">Confirmar
                                Entrega</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/amountUser.js') }}"></script>
@endsection
