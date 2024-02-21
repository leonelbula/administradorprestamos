@extends('layouts.app')
@section('title')
{{$title}}   
@endsection
<?php  date_default_timezone_set('America/Bogota'); ?>
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('credit.listar')}}" class="btn btn-success btn-sm btn-icon-split">      
            <span class="text">Cancelar</span>
        </a>
        <a href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#customerModal">      
         <span class="text">Agregar Cliente</span>
     </a>
     <a href="#" class="btn btn-success btn-sm btn-icon-split">      
      <span class="text">Limpiar</span>
  </a>
    </div>
    <div class="card-body">
        <div class="col-lg-7">
            <div class="p-2">
                <form class="user" method="POST" action="{{route('credit.update',$credit)}}">
                  @method('put')
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control " name="fullname" id="fullname" value="{{ $credit->customer->fullname}}" placeholder="Nombre Cliente" disabled>
                        <input type="hidden" name="id" id="id" value="{{ $credit->customer_id}}">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="number" class="form-control " name="amount" id="amount" value="{{$credit->amount}}" placeholder="Valor Prestamo">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control " name="total" id="total" value="{{$credit->balance}}" placeholder="Valor a Pagar">
                        </div>
                    </div>                   
                    <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <input type="number" class="form-control " name="interest" id="interest" value="{{credit->interest}}" placeholder="Interes">
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <input type="phone" class="form-control " name="quota_number" id="quota_number" value="{{ $credit->quota_number}}" placeholder="Numero dias">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control " name="date" id="date" value="{{ $credit->date }}"  placeholder="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Editar Prestamo</button>             
                    
                </form>               
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="customerget" value="{{ route('ajaxcustomer.get') }}">
@endsection

<div class="modal fade tableCustomer" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lista de clientes</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                            <th>#</th>
                            <th>Nombre</th>
                             <th>Barrio</th>                           
                             <th>Aciones</th>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                           <td>{{$customer->id}}</td>
                           <td>{{ $customer->fullname }}</td>
                           <td>{{ $customer->direction }}</td>                                              
                           <td>
                              <button class="btn btn-success agregarCliente recuperarBoton" type="button" id="customer_id" data-id="{{$customer->id}}">Agregar</button>
                           </td>
                       </tr>               
                            
                        @endforeach                 
                        
                     </tbody>
                 </table>
               </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
 </div>
@section('script')
<script src="{{ asset('js/customer.js')}}"></script>
<script src="{{ asset('js/credit.js')}}"></script>
@endsection