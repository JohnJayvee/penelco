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
        <p class="text-dim  float-right">EOR-PHP Processor Portal / Processors</p>
      </div>
    </div>
  
  </div>

  <div class="col-12 ">
    <form>
      <div class="row">
        <div class="col-md-3">
          <label>Bureau/Office</label>
          @if(Auth::user()->type == "super_user" || Auth::user()->type == "admin")
            {!!Form::select("department_id", $department, $selected_department_id, ['id' => "input_department_id", 'class' => "custom-select"])!!}
          @elseif(Auth::user()->type == "office_head")
            <input type="text" class="form-control mb-2 mr-sm-2" value="{{Auth::user()->department->name}}" readonly>
            <input type="hidden" name="selected_department_id" value="{{$selected_department_id}}">
          @endif
        </div>
        <div class="col-md-3">
          <label>Keywords</label>
          <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" class="form-control mb-2 mr-sm-2" id="input_keyword" name="keyword" value="{{$keyword}}" placeholder="Keyword">
          </div>
        </div>
        <div class="col-md-3 mt-4 p-1">
          <button class="btn btn-primary btn-sm p-2" type="submit">Filter</button>
          <a href="{{route('system.processor.list')}}" class="btn btn-primary btn-sm p-2">Clear</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-12">
    <h4 class="pb-4">Record Data</h4>
    <div class="shadow fs-15 table-responsive">
      <table class="table  table-striped table-wrap" style="table-layout: fixed;">
        <thead>
          <tr>
            <th class="text-title p-3" width="35%">Name</th>
            <th class="text-title p-3" width="35%"># of Application Processed</th>
            <th class="text-title p-3" width="35%">Bureau/Office</th>
            <th class="text-title p-3" width="30%">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($processors as $processor)
          <tr>
            <td>{{ $processor->full_name}}</td>
            <td>{{ Helper::processed_count($processor->id)}} as of {{Helper::date_format(Carbon::now())}}</td>
            <td>{{ Str::title($processor->department ? $processor->department->name : "N/A")}}</td>
            <td >
              <button type="button" class="btn btn-sm p-0" data-toggle="dropdown" style="background-color: transparent;"> <i class="mdi mdi-dots-horizontal" style="font-size: 30px"></i></button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton2">
                <a class="dropdown-item" href="{{route('system.processor.show',[$processor->id])}}">View Details</a>
              </div>
            </td>
          </tr>
          @empty
          <tr>
           <td colspan="6" class="text-center"><i>No Accounts Records Available.</i></td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($processors->total() > 0)
      <nav class="mt-2">
       <!--  <p>Showing <strong>{{$processors->firstItem()}}</strong> to <strong>{{$processors->lastItem()}}</strong> of <strong>{{$processors->total()}}</strong> entries</p> -->
        {!!$processors->appends(request()->query())->render()!!}
        </ul>
      </nav>
    @endif
  </div>
</div>
@stop

@section('page-modals')
<div id="confirm-delete" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm your action</h5>
      </div>

      <div class="modal-body">
        <h6 class="text-semibold">Deleting Record...</h6>
        <p>You are about to delete a record, this action can no longer be undone, are you sure you want to proceed?</p>

        <hr>

        <h6 class="text-semibold">What is this message?</h6>
        <p>This dialog appears everytime when the chosen action could hardly affect the system. Usually, it occurs when the system is issued a delete command.</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <a href="#" class="btn btn-sm btn-danger" id="btn-confirm-delete">Delete</a>
      </div>
    </div>
  </div>
</div>
@stop
@section('page-styles')
<style type="text/css" >
  .btn-sm{
    border-radius: 10px;
  }
</style>

@stop
@section('page-scripts')
<script src="{{asset('system/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
  $(function(){
   

    $(".action-delete").on("click",function(){
      var btn = $(this);
      $("#btn-confirm-delete").attr({"href" : btn.data('url')});
    });

  })
</script>
@stop