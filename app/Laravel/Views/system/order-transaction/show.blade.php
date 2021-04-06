@extends('system._layouts.main')

@section('content')
<div class="row px-5 py-4">
  <div class="col-12">
    @include('system._components.notifications')
    <div class="row ">
      <div class="col-md-6">
        <h5 class="text-title text-uppercase">{{$page_title}}</h5>
      </div>
      <div class="col-md-6 ">
        <p class="text-dim  float-right">EOR-PHP Processor Portal / Transactions / Transaction Details</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-7">
      <h5 class="text-blue fs-15 m-2">Bill Transaction Details</h5>
      <div class="card">
        <div class="card-body text-center">
          <div class="row mt-2">
            <div class="col-md-6">
              <h5 class="text-title fs-15 float-left">Payment Reference Number: </h5>
            </div>
             <div class="col-md-6">
              <h5 class="float-right fs-15">{{$bill_transaction->transaction_code}}</h5>
            </div>
          </div>
           <div class="row">
            <div class="col-md-6">
              <h5 class="text-title fs-15 float-left">Account Number: </h5>
            </div>
            <div class="col-md-6">
              <h5 class="float-right fs-15"> {{$bill_transaction->account_number}}</h5>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <h5 class="text-title fs-15 float-left">Bill Month: </h5>
            </div>
            <div class="col-md-6">
              <h5 class="float-right fs-15">{{Helper::date_only($bill_transaction->bill->bill_month)}}</h5>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <h5 class="text-title fs-15 float-left">Due Date: </h5>
            </div>
            <div class="col-md-6">
              <h5 class="float-right fs-15">{{Helper::date_only($bill_transaction->bill->due_date)}}</h5>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-6">
              <h5 class="text-title fs-15 float-left">Total Amount: PHP {{Helper::money_format($bill_transaction->total_amount)}}</h5>
            </div>
             <div class="col-md-6">
              <h5 class="float-right fs-15">Payment Status: <span class="badge badge-{{Helper::status_badge($bill_transaction->payment_status)}} p-2">{{Str::title($bill_transaction->payment_status)}}</span></h5>
            </div>
          </div>
        </div>
      </div>

      {{-- @include('system.order-transaction.partial-payment-details') --}}

      {{-- @include('system.order-transaction.penalty-details-history') --}}

      <a href="{{route('system.order_transaction.pending')}}" class="btn btn-light float-right mt-2">Return to Order Transaction list</a>
    </div>
    <div class="col-md-5">
      <h5 class="text-blue fs-15 m-2">Request form Details</h5>
      <div class="card mb-4">
        <div class="card-body">

          <div class="row">
            <div class="col-md-6">
              <p class="text-blue float-left">Payor:</p>
            </div>
            <div class="col-md-6">
              <p class="float-right text-uppercase" style="text-align: right;">{{$bill_transaction->payor}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="text-blue float-left">Telephone/Mobile Number :</p>
            </div>
            <div class="col-md-6">
              <p class="float-right text-uppercase" style="text-align: right;">{{$bill_transaction->contact_number}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p class="text-blue float-left">Email :</p>
            </div>
            <div class="col-md-6">
              <p class="float-right text-uppercase" style="text-align: right;">{{$bill_transaction->email}}</p>
            </div>
          </div>

          <img src="{{asset('web/img/penelco-logo.png')}}" alt="logo" class="img-fluid float-right" width="30%">
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('page-styles')
<link rel="stylesheet" href="{{asset('system/vendors/sweet-alert2/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<style type="text/css" >
  .input-daterange input{ background: #fff!important; }
  .isDisabled{
    color: currentColor;
    display: inline-block;  /* For IE11/ MS Edge bug */
    pointer-events: none;
    text-decoration: none;
    cursor: not-allowed;
    opacity: 0.5;
  }
</style>
@stop

@section('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('system/vendors/sweet-alert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
  $(function(){
    $('.input-daterange').datepicker({
      format : "yyyy-mm-dd"
    });
    $(".btn-paid").on('click', function(){
      var url = $(this).data('url');
      var self = $(this)
      Swal.fire({
        title: "Please put Receipt Number in the field below. Are you sure you want to tag as paid this application? You can't undo this action.?",
        icon: 'info',
        input: 'text',
        inputPlaceholder: "Put Receipt Number",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Proceed!',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if (result.value === "") {
          alert("You need to write something")
          return false
        }
        if (result.value) {
          window.location.href = url + "?receipt_number="+result.value;
        }
      });
    });


  })
</script>
@stop
