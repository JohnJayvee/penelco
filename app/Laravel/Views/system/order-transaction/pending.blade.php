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
        <p class="text-dim  float-right">EOR-PHP Processor Portal / For Payment Transaction List</p>
      </div>
    </div>
  
  </div>

  <div class="col-12 ">
    <form>
      <div class="row">
        <div class="col-md-3">
          <label>Date Range</label>
          <div class="input-group input-daterange d-flex align-items-center">
            <input type="text" class="form-control mb-2 mr-sm-2" value="{{$start_date}}" readonly="readonly" name="start_date">
            <div class="input-group-addon mx-2">to</div>
            <input type="text" class="form-control mb-2 mr-sm-2" value="{{$end_date}}" readonly="readonly" name="end_date">
          </div>
        </div>
         <div class="col-md-4">
          <label>Keyword</label>
          <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control mb-2 mr-sm-2" id="input_keyword" name="keyword" value="{{$keyword}}" placeholder="Reference Number, Payor, Reference/Transaction/Serial Number">
          </div>
        </div>
        <div class="col-md-2 mt-4">
          <button class="btn btn-primary btn-sm p-2" type="submit">Filter</button>
          <a href="{{route('system.order_transaction.pending')}}" class="btn btn-primary btn-sm p-2">Clear</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-12">
    <h4 class="pb-4">Record Data
      @if($auth->type != "cashier")
      <span class="float-right">
        <a href="{{route('system.order_transaction.upload')}}" class="btn btn-sm btn-primary">Upload Excel File</a>
      </span>
      @endif
    </h4>
    <div class="shadow-sm fs-15 table-responsive">
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
</style>

@stop

@section('page-scripts')
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
  $(function(){
    $('.input-daterange').datepicker({
      format : "yyyy-mm-dd"
    });

    $(".action-delete").on("click",function(){
      var btn = $(this);
      $("#btn-confirm-delete").attr({"href" : btn.data('url')});
    });
  })
</script>
@stop