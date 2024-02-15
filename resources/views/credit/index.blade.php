@extends('layouts.app')
@section('title')
    {{$title}}
@endsection
@section('buttom')
<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
@endsection
@section('content')
<div class="card shadow mb-4">
   <div class="card-header py-3">
       <a href="{{ route('cliente.create')}}" class="btn btn-success btn-sm btn-icon-split">      
        <span class="text">Nuevo</span>
    </a>
    <a href="#" class="btn btn-danger btn-sm btn-icon-split">
     <span class="text">En Mora</span>
  </a>
   </div>
   <div class="card-body">
       <div class="table-responsive">
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                   <tr>
                       <th>Fecha</th>
                       <th>Cliente</th>
                       <th>Valor</th>
                       <th>Saldo</th>
                       <th>Cuotas pendiente</th>
                       <th>Estado</th>
                       <th>Aciones</th>
                   </tr>
               </thead>
               <tbody>
                  @foreach ($credits as $credit)
                  <tr>
                     <td>{{ $credit->created_at }}</td>
                     <td>{{ $credit->customer->fullname}}</td>
                     <td>{{  $credit->amount }}</td>
                     <td>{{  $credit->balance }}</td>
                     <td>{{  $credit->quota_number_pendieng}}</td>
                     <td><button class="btn btn-sm btn-success shadow-sm">Al dia</button></td>                             
                     <td>
                        <a href="{{ route('cliente.show',$credit) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('cliente.edit',$credit)}}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                     </td>
                 </tr>               
                      
                  @endforeach                 
                  
               </tbody>
           </table>
       </div>
   </div>
</div>
@endsection
