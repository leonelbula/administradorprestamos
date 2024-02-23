@extends('layouts.app')
@section('title')
{{$title}}   
@endsection
<?php  date_default_timezone_set('America/Bogota'); ?>
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('cliente.index')}}" class="btn btn-success btn-sm btn-icon-split">      
            <span class="text">Cancelar</span>
        </a>
        <a href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#customerModal">      
         <span class="text">Agregar Cliente</span>
     </a>
     <a href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#cobradorModal">      
      <span class="text">Agregar Cobrador</span>
  </a>
     <a href="#" class="btn btn-success btn-sm btn-icon-split">      
      <span class="text">Limpiar</span>
  </a>
    </div>
    <div class="card-body">
        <div class="col-lg-7">
            <div class="p-2">
                <form class="user" method="POST" action="{{route('credit.savecobrador')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control " name="fullname" id="fullname" value="{{old('fullname')}}" placeholder="Nombre Cliente" disabled>
                        <input type="hidden" name="id" id="id" value="">
                    </div> 
                    <div class="form-group">
                     <input type="text" class="form-control " name="user" id="user" value="{{old('user')}}" placeholder="Nombre del cobrador" disabled>
                     <input type="hidden" name="userid" id="userid" value="">
                     </div>                                
                    
                    <button type="submit" class="btn btn-primary btn-block" id="">Guardar</button>             
                    
                </form>               
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="customerget" value="{{ route('ajaxcustomer.get') }}">
<input type="hidden" id="userget" value="{{ route('ajaxuser.get') }}">

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
 <div class="modal fade tableCustomer" id="cobradorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Lista de Empleador</h5>
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
                        <th>Aciones</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($users as $user)
                   <tr>
                      <td>{{$user->id}}</td>
                      <td>{{ $user->name }}</td>                                                          
                      <td>
                         <button class="btn btn-success agregarCobrador " type="button" id="btnUser" data-id="{{$user->id}}">Agregar</button>
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
</div
@section('script')
<script src="{{ asset('js/customer.js')}}"></script>
<script src="{{ asset('js/credit.js')}}"></script>
<script src="{{ asset('js/asignarCredit.js')}}"></script>
@endsection