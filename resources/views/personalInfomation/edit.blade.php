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
                    <form class="user" method="POST" action="{{ route('user.update', $empleado) }}">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                            <input type="text" class="form-control " name="name" id="name"
                                value="{{ $empledo->name) }}" placeholder="Nombre completo" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                @if ($errors->has('type'))
                                    <div class="alert alert-danger">{{ $errors->first('type') }}</div>
                                @endif
                                <select name="type" id="type" class="form-control ">
                                    <option value="cobrador">Cobrador</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control " name="password" id="password"
                                    value="{{ old('password') }}" placeholder="Contraseña">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Editar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
