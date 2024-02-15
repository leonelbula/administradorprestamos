@extends('layouts.app')
@section('title')
{{$title}}   
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('cliente.listar')}}" class="btn btn-success btn-sm btn-icon-split">      
            <span class="text">Volver</span>
        </a>
    </div>
    <div class="card-body">
        <div class="col-lg-9">
            <div class="p-2">
               <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ strtoupper($customer->fullname)}}</h6>
              </div>         
            </div>
            <div class="card-body">
              <ul>
               <li>{{$customer->identification }}</li>
               <li>{{$customer->direction }}</li>
               <li>{{$customer->phone }}</li>
               <li>{{$customer->city }}</li>
              </ul>
              <hr>
              <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Cobrador Asignado</h6>               
           </div>  
           <ul>
            <li>ppppp</li>
         </ul>
              <hr>             
              <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Informacion de Prestamos</h6>
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Entregado</th>
                          <th>Valor</th>
                          <th>Saldo</th>
                          <th>Cuotas Pendiente</th>  
                          <th>Fecha Vencimento</th>                          
                          <th>Aciones</th>
                      </tr>
                  </thead>
                  <tbody>
                     @foreach ($customer->credit as $credit)
                     <tr>                       
                        <td>{{ $credit->created_at}}</td>
                        <td>{{$credit->amount}}</td>
                        <td>{{ $credit->balance }}</td>
                        <td>{{ $credit->quota_number_pendieng }}</td> 
                        <td>{{ $credit->expiration_date }}</td> 
                        <td>
                           <a href="{{ route('cliente.show',$customer) }}" class="btn btn-info btn-sm">
                              <i class="fas fa-eye"></i>
                          </a>
                        </td>
                     </tr>               
                          
                      @endforeach                 
                      
                   </tbody>
               </table>
           </div>       
           </div>
        </div>
    </div>
</div>
@endsection
