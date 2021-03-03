@extends('web._layouts.main')


@section('content')



<!--team section start-->
<section class="pt-110 pb-80 gray-light-bg">
    <div class="container-fluid" style="padding: 0 6em;">
        @include('web._components.notifications')
        <div class="row">
            <div class="col-md-7"> 
                <h5 class="text-blue fs-15 m-2">Order Details</h5>
                <div class="card"> 
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-6">
                              <p class="text-blue float-left">Payment Reference Number:</p>
                            </div>
                            <div class="col-md-6">
                                <p class="float-right"> {{$transaction->transaction_code}}</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                              <p class="text-blue float-left">Account Number: </p>
                            </div>
                             <div class="col-md-6">
                              <p class="float-right">{{$transaction->account_number}}</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                              <p class="text-blue float-left">Bill Month: </p>
                            </div>
                            <div class="col-md-6">
                              <p class="float-right">{{Helper::date_format($transaction->bill->bill_month)}}</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                              <p class="text-blue float-left">Due Date: </p>
                            </div>
                            <div class="col-md-6">
                              <p class="float-right">{{Helper::date_format($transaction->bill->due_date)}}</p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                              <p class="text-blue float-left">Payment Status: </p>
                            </div>
                            <div class="col-md-6">
                              <p class="text-blue float-right"><span class="badge badge-{{Helper::status_badge($transaction->payment_status)}} p-2">{{Str::title($transaction->payment_status)}}</span></p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                              <p class="text-blue float-left">Total Amount: PHP {{Helper::money_format($transaction->total_amount)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($transaction->bill_type == "FULL")
                  <a data-url="{{ route('web.request_partial', [$code]) }}"  class="btn btn-partial btn-badge-primary fs-14 float-right mt-2">  Request Partial Payment </a>
                @endif
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
                                <p class="float-right text-uppercase" style="text-align: right;">{{$transaction->payor}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-blue float-left">Address :</p>
                            </div>
                            <div class="col-md-6">
                                <p class="float-right text-uppercase" style="text-align: right;">{{$transaction->address}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-blue float-left">Telephone/Mobile Number :</p>
                            </div>
                            <div class="col-md-6">
                                <p class="float-right text-uppercase" style="text-align: right;">{{$transaction->contact_number}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-blue float-left">Email :</p>
                            </div>
                            <div class="col-md-6">
                                <p class="float-right text-uppercase" style="text-align: right;">{{$transaction->email}}</p>
                            </div>
                        </div>
                      
                        <img src="{{asset('web/img/penelco-logo.png')}}" alt="logo" class="img-fluid float-right" width="30%">
                    </div>
                </div>

                <a href="{{ route('web.pay', [$code]) }}" class="btn btn-badge-primary fs-14 float-right"><i class="fa fa-check pr-2"></i>  Proceed to Pay </a>
                 <a href="{{route('web.main.index')}}" class="btn btn-badge-danger float-right mr-2">Cancel</a>
            </div>
        </div>
        
    </div>

</section>
<!--team section end-->


@stop

@section('page-styles')
<!-- <link rel="stylesheet" href="{{asset('system/vendors/sweet-alert2/sweetalert2.min.css')}}"> -->
<link rel="stylesheet" href="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('system/vendors/select2/select2.min.css')}}"/>
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
  .is-invalid{
    border: solid 2px;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice{
    font-size: 18px;
  }
  span.select2.select2-container{
    width: 100% !important;
  }
  textarea.swal2-textarea {
    width: 25em;
  }
</style>
@stop
@section('page-scripts')
<script src="{{asset('system/vendors/swal/sweetalert.min.js')}}"></script>
<!-- <script src="{{asset('system/vendors/sweet-alert2/sweetalert2.min.js')}}"></script> -->
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('system/vendors/select2/select2.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
    $(".btn-partial").on('click', function(){
      var url = $(this).data('url');
      var self = $(this)
      Swal.fire({
        title: "Please put Partial Amount. ",
        text:"Are you sure you want to submit this request? You can't undo this action.?",
        icon: 'info',
        input: 'text',
        inputPlaceholder: "Put Amount",
        showCancelButton: true,
        confirmButtonText: 'Proceed',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if (result.value === "") {
          alert("You need to write something")
          return false
        }
        if (result.value) {
          window.location.href = url + "?amount="+result.value;
        }
      });
    });
});
</script>

@endsection