@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
<?php date_default_timezone_set('America/Bogota'); ?>
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('cliente.index') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Cancelar</span>
            </a>

        </div>
        <div class="card-body">
            <div class="col-lg-7">
                <div class="p-2">
                    <form class="user" method="POST" action="{{ route('bill.update', $bill) }}">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="date" class="form-control " name="date" id="date"
                                    value="{{ $bill->date }}" placeholder="" required>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control " name="amount" id="amount"
                                    value="{{ $bill->amount }}" placeholder="Valor" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control " id="description" cols="3" rows="5" required>{{ $bill->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" id="btnSave">Registrar gasto</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
