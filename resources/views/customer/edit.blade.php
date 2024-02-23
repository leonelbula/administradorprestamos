@extends('layouts.app')
@section('title')
{{$title}}   
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('cliente.index')}}" class="btn btn-success btn-sm btn-icon-split">      
            <span class="text">Cancelar</span>
        </a>
    </div>
    <div class="card-body">
        <div class="col-lg-7">
            <div class="p-2">
                <form class="user" method="POST" action="{{route('cliente.update', $customer )}}" >
                    @method('put')
                    @csrf                   
                    <div class="form-group">
                        <input type="text" class="form-control " name="fullname" id="fullname" value="{{$customer->fullname}}" placeholder="Nombre completo">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control " name="identification" id="identification" value="{{$customer->identification}}" placeholder="Identificacion">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control " name="city" id="city" value="{{$customer->city}}" placeholder="Ciudad">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control " name="direction" id="direction" value="{{$customer->direction}}" placeholder="Direccion">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="phone" class="form-control " name="phone" id="phone" value="{{$customer->phone}}" placeholder="Telefono">
                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control " name="email" id="email" value="{{$customer->email}}"  placeholder="Email">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Editar</button>             
                    
                </form>               
            </div>
        </div>
    </div>
</div>
@endsection
