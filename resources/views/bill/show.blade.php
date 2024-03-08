@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('bill.index') }}" class="btn btn-success btn-sm btn-icon-split">
                <span class="text">Volver</span>
            </a>
        </div>
        <div class="card-body">
            <div class="col-lg-9">
                <div class="p-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{ strtoupper($bill->date) }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <ul>
                        <li>{{ $bill->amount }}</li>
                    </ul>
                    <hr>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informacion de Gasto</h6>
                        <ul>
                            <li>{{ $bill->description }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
