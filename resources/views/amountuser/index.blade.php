@extends('layouts.app')
@section('title')
{{$title}}   
@endsection
<?php  date_default_timezone_set('America/Bogota'); ?>
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('loanpayment.index')}}" class="btn btn-success btn-sm btn-icon-split">      
            <span class="text">cobros</span>
        </a>
        <a href="#" class="btn btn-success btn-sm btn-icon-split" >      
         <span class="text">Reportes</span>
     </a>
    </div>
   
            <div class="p-2">
               <div class="row">
                  <div class="col-lg-4 mb-4">
                     <div class="card-body">
                        Nombre del cobrador
                        <div class="text-black-50 p-2">Efectivo Entregado <br>1.000.000</div>                        
                        <div class="text-black-50 p-2">Saldo sin entregar <br>100.000</div>
                        <a href="#" class="btn btn-success btn-sm btn-icon-split" >      
                           <span class="text">Ver</span>
                       </a>
                    </div>    
                  </div>
                  <div class="col-lg-4 mb-4">
                     <div class="card-body">
                        Nombre del cobrador
                        <div class="text-black-50 p-2">Efectivo Entregado <br>1.000.000</div>                        
                        <div class="text-black-50 p-2">Saldo sin entregar <br>100.000</div>
                        <a href="#" class="btn btn-success btn-sm btn-icon-split" >      
                           <span class="text">Ver</span>
                       </a>
                    </div>    
                  </div>
                  <div class="col-lg-4 mb-4">
                     <div class="card-body">
                        Nombre del cobrador
                        <div class="text-black-50 p-2">Efectivo Entregado <br>1.000.000</div>                        
                        <div class="text-black-50 p-2">Saldo sin entregar <br>100.000</div>
                        <a href="#" class="btn btn-success btn-sm btn-icon-split" >      
                           <span class="text">Ver</span>
                       </a>
                    </div>      
                  </div>
                  <div class="col-lg-4 mb-4">
                     <div class="card-body">
                        Nombre del cobrador
                        <div class="text-black-50 p-2">Efectivo Entregado <br>1.000.000</div>                        
                        <div class="text-black-50 p-2">Saldo sin entregar <br>100.000</div>
                        <a href="#" class="btn btn-success btn-sm btn-icon-split" >      
                           <span class="text">Ver</span>
                       </a>
                    </div>      
                  </div>
                  <div class="col-lg-4 mb-4">
                     <div class="card-body">
                        Nombre del cobrador
                        <div class="text-black-50 p-2">Efectivo Entregado <br>1.000.000</div>                        
                        <div class="text-black-50 p-2">Saldo sin entregar <br>100.000</div>
                        <a href="#" class="btn btn-success btn-sm btn-icon-split" >      
                           <span class="text">Ver</span>
                       </a>
                    </div>       
                  </div>
                  <div class="col-lg-4 mb-4">
                     <div class="card-body">
                        Nombre del cobrador
                        <div class="text-black-50 p-2">Efectivo Entregado <br>1.000.000</div>                        
                        <div class="text-black-50 p-2">Saldo sin entregar <br>100.000</div>
                        <a href="#" class="btn btn-success btn-sm btn-icon-split" >      
                           <span class="text">Ver</span>
                       </a>
                    </div>    
                  </div>
               </div>              
       </div>
</div>
<input type="hidden" id="customerget" value="{{ route('ajaxcustomer.get') }}">
@endsection


@section('script')
<script src="{{ asset('js/customer.js')}}"></script>
<script src="{{ asset('js/customeloanpay.js')}}"></script>
@endsection