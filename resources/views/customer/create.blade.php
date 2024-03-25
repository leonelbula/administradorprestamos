@extends('layouts.app')
@section('title')
    {{ $title }}
@endsection
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
                    <form class="user" method="POST" action="{{ route('cliente.save') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control " name="fullname" id="fullname"
                                value="{{ old('fullname') }}" placeholder="Nombre completo">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control " name="identification" id="identification"
                                    value="{{ old('identification') }}" placeholder="Identificacion">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " name="city" id="city"
                                    value="{{ old('city') }}" placeholder="Ciudad">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control " name="direction" id="direction"
                                value="{{ old('direction') }}" placeholder="Direccion">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="phone" class="form-control " name="phone" id="phone"
                                    value="{{ old('phone') }}" placeholder="Telefono">
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control " name="email" id="email"
                                    value="{{ old('email') }}" placeholder="Email">
                            </div>
                        </div>
                        @if (auth()->user()->type == 'admin')
                            <div class="form-group">
                                <label for="">Cobrador encargado</label>
                                <select name="user_id" id="user_id" class="form-control " required>
                                    <option>Cobrador Asignado</option>
                                    @foreach ($cobrador as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="">Cobrador encargado</label>
                                <input type="text" class="form-control " name="" id=""
                                    value="{{ auth()->user()->name }}" disabled>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
