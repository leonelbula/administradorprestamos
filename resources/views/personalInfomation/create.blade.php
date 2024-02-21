@extends('layouts.app')
@section('title')
{{$title}}   
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('cliente.listar')}}" class="btn btn-success btn-sm btn-icon-split">      
            <span class="text">Cancelar</span>
        </a>
    </div>
    <div class="card-body">
        <div class="col-lg-7">
            <div class="p-2">
                <form class="user" method="POST" action="{{route('register')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control " name="fullname" id="fullname" value="{{old('fullname')}}" placeholder="Nombre completo">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="email" class="form-control " name="email" id="email" value="{{old('email')}}"  placeholder="Email">
                        </div>   
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control " name="password" id="password" value="{{old('password')}}" placeholder="Contraseña">
                        </div>                 
                    </div>                    
                   
                    
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>             
                    
                </form>               
            </div>
        </div>
    </div>
</div>
@endsection
