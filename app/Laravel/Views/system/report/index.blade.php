@extends('system._layouts.main')

@section('content')
<div class="row p-3">
  <div class="col-12">
    @include('system._components.notifications')
    <div class="row ">
      <div class="col-md-6">
        <h5 class="text-title text-uppercase">{{$page_title}}</h5>
      </div>
      <div class="col-md-6 ">
        <p class="text-dim  float-right">EOR-PHP Processor Portal / Report</p>
      </div>
    </div>
  
  </div>

  <div class="col-12 ">
     <form>
      <div class="row">
        <div class="col-md-3 p-2">
          <label>Date Range</label>
          <div class="input-group input-daterange d-flex align-items-center">
            <input type="text" class="form-control mb-2 mr-sm-2" value="{{$start_date}}" readonly="readonly" name="start_date">
            <div class="input-group-addon mx-2">to</div>
            <input type="text" class="form-control mb-2 mr-sm-2" value="{{$end_date}}" readonly="readonly" name="end_date">
          </div>
        </div>
        <div class="col-md-3 p-2">
          <label>Payment Status</label>
          {!!Form::select("payment_status", $status, $selected_payment_status, ['id' => "input_payment_status", 'class' => "custom-select"])!!}
        </div>
        <div class="col-md-3 p-2">
          <label>Keyword</label>
          <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control mb-2 mr-sm-2" id="input_keyword" name="keyword" value="{{$keyword}}" placeholder="Reference Number, Payor, Reference/Transaction/Serial Number">
          </div>
        </div>
        <div class="col-md-3 p-2 mt-4">
          <button class="btn btn-primary btn-sm p-2" type="submit">Filter</button>
          <a href="{{route('system.report.index')}}" class="btn btn-primary btn-sm p-2">Clear</a>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-4">
          <a href="{{route('system.report.export')}}?keyword={{$keyword}}&start_date={{$start_date}}&end_date={{$end_date}}&payment_status={{$selected_payment_status}}" class="btn btn-primary btn-sm p-2">Export Excel</a>
          <a href="{{route('system.report.pdf')}}?keyword={{$keyword}}&start_date={{$start_date}}&end_date={{$end_date}}&payment_status={{$selected_payment_status}}" class="btn btn-primary btn-sm p-2 ">Export PDF</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-12">
     <div class="shadow-sm fs-15">
      <table class="table table-striped table-wrap">
        <thead>
          <tr class="text-center">
            <th class="text-title p-3">Bill Month</th>
            <th class="text-title p-3">Account Number</th>
            <th class="text-title p-3">Transaction Code</th>
            <th class="text-title p-3">Account Name</th>
            <th class="text-title p-3">Due Date</th>
            <th class="text-title p-3">Amount/Status</th>
            <th class="text-title p-3">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($bills as $bill)
          <tr class="text-center">
            <td>{{ Helper::date_only($bill->bill_month)}}</td>
            <td>{{$bill->account_number}}</td>
            <td>{{Helper::get_transaction_number($bill->id)}}</td>
            <td>{{$bill->account_name}} </td>
            <td>{{ Helper::date_only($bill->due_date)}}</td>
            <td>{{Helper::money_format($bill->amount ?: 0)}} <br> <span class="badge badge-{{Helper::status_badge($bill->payment_status)}} p-2">{{Str::title($bill->payment_status)}}</span></td>
            <td>
              <button type="button" class="btn btn-sm p-0" data-toggle="dropdown" style="background-color: transparent;"> <i class="mdi mdi-dots-horizontal" style="font-size: 30px"></i></button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton2">
                <a class="dropdown-item" href="{{route('system.order_transaction.show',[$bill->id])}}">View transaction</a>
               <!--  <a class="dropdown-item action-delete"  data-url="#" data-toggle="modal" data-target="#confirm-delete">Remove Record</a> -->
              </div>
            </td>
          </tr>
          @empty
          <tr>
           <td colspan="8" class="text-center"><i>No Order transaction Records Available.</i></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($bills->total() > 0)
      <nav class="mt-2">
        <p>Showing <strong>{{$bills->firstItem()}}</strong> to <strong>{{$bills->lastItem()}}</strong> of <strong>{{$bills->total()}}</strong> entries</p>
        {!!$bills->appends(request()->query())->render()!!}
        </ul>
      </nav>
    @endif
  </div>
</div>
@stop


@section('page-styles')
<link rel="stylesheet" href="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
<style type="text/css" >
  .input-daterange input{ background: #fff!important; }  
  .btn-sm{
    border-radius: 10px;
  }
  .form-group{
    margin-bottom: 5px!important;
  }
</style>

@stop

@section('page-scripts')
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
  $.fn.get_application = function(department_id,input_purpose,selected){
        $(input_purpose).empty().prop('disabled',true)
        $(input_purpose).append($('<option>', {
                  value: "",
                  text: "Loading Content..."
              }));
        $.getJSON( "{{route('web.get_application')}}?department_id="+department_id, function( result ) {
            $(input_purpose).empty().prop('disabled',true)
            $.each(result.data,function(index,value){
              // console.log(index+value)
              $(input_purpose).append($('<option>', {
                  value: index,
                  text: value
              }));
            })

            $(input_purpose).prop('disabled',false)
            $(input_purpose).prepend($('<option>',{value : "",text : "--Choose Application Type--"}))

            if(selected.length > 0){
              $(input_purpose).val($(input_purpose+" option[value="+selected+"]").val());

            }else{
              $(input_purpose).val($(input_purpose+" option:first").val());
              //$(this).get_extra(selected)
            }
        });
        // return result;
    };

  $(function(){
    $('.input-daterange').datepicker({
      format : "yyyy-mm-dd"
    });

    $(".action-delete").on("click",function(){
      var btn = $(this);
      $("#btn-confirm-delete").attr({"href" : btn.data('url')});
    });

    $("#input_department_id").on("change",function(){
      var department_id = $(this).val()
      var _text = $("#input_department_id option:selected").text();
      $(this).get_application(department_id,"#input_application_id","")
      $('#input_department_name').val(_text);
    })


  })
</script>
@stop