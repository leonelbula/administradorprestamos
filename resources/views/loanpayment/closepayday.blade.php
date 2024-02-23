@extends('layouts.app')
@section('title')
{{$title}}   
@endsection
<?php  date_default_timezone_set('America/Bogota'); ?>
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('loanpayment.index')}}" class="btn btn-success btn-sm btn-icon-split">      
            <span class="text">Cancelar</span>
        </a>
        <a href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#loanpaycloseModal">      
         <span class="text">Cerrar</span>
     </a>
    </div>
    <div class="card-body">
        <div class="col-lg-7">
            <div class="p-2">
                <form class="user" method="POST" action="{{route('credit.save')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control " name="fullname" id="fullname" value="{{old('fullname')}}" placeholder="Nombre Cliente" disabled>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="credit_id" id="credit_id" value="">

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="number" class="form-control " name="" id="valcredit" value="" placeholder="Valor de Credito" disabled>
                        </div>
                        <div class="col-sm-6">
                           <input type="number" class="form-control " name="" id="numcouta" value="29"  placeholder="" disabled>
                       </div>
                    </div>  
                    <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                         <input type="number" class="form-control " name="amount" id="amount" value="{{old('amount')}}" placeholder="Valor cuota">
                     </div>
                     <div class="col-sm-6">
                        <input type="date" class="form-control " name="date" id="date" value="{{ date('Y-m-d') }}"  placeholder="">
                    </div>
                 </div>                       
                    
                    <button type="submit" class="btn btn-primary btn-block" id="Save">Guardar</button>             
                    
                </form>               
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="customerget" value="{{ route('ajaxcustomer.get') }}">
@endsection

<div class="modal fade " id="loanpaycloseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lista de clientes</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form class="user" method="POST" action="{{route('credit.save')}}">
                     @csrf
                     <div class="form-group">
                         <input type="text" class="form-control " name="fullname" id="fullname" value="{{old('fullname')}}" placeholder="Nombre de cobrador" disabled>
                         <input type="hidden" name="id" id="id" value="">
                         <input type="hidden" name="credit_id" id="credit_id" value="">
 
                     </div>                    
                     <div class="form-group row">                     
                      <div class="col-sm-6">
                         <input type="date" class="form-control " name="date" id="date" value="{{ date('Y-m-d') }}"  placeholder="">
                     </div>
                  </div>                       
                     
                     <button type="submit" class="btn btn-primary btn-block" id="Save">Guardar</button>             
                     
                 </form>      
               </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
 </div>
@section('script')
<script src="{{ asset('js/customer.js')}}"></script>
<script src="{{ asset('js/customeloanpay.js')}}"></script>
@endsection