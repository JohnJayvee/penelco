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
        <p class="text-dim  float-right">EOR-PHP Accounts Portal / Accounts</p>
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
          <label>Account Type</label>
          {!!Form::select("type", $user_type, $selected_type, ['id' => "input_type", 'class' => "custom-select"])!!}
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
          <a href="{{route('system.processor.index')}}" class="btn btn-primary btn-sm p-2">Clear</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-12">
    <h4 class="pb-4">Record Data
      <span class="float-right">
        <a href="{{route('system.processor.create')}}" class="btn btn-sm btn-primary">Add New</a>
      </span>
    </h4>
    <div class="shadow fs-15">
      <table class="table table-responsive table-striped table-wrap" style="table-layout: fixed;">
        <thead>
          <tr>
            <th width="25%" class="text-title p-3">Reference #</th>
            <th width="25%" class="text-title p-3">Last Name</th>
            <th width="25%" class="text-title p-3">First Name</th>
            <th width="10%" class="text-title p-3">Bureau/Office</th>
            <th width="10%" class="text-title p-3">Status</th>
            <th width="10%" class="text-title p-3">Type</th>
            <th width="10%" class="text-title p-3">Date Created</th>
            <th width="10%" class="text-title p-3">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($processors as $processor)
          <tr>
            <td>{{ $processor->reference_id}}</td>
            <td>{{ Str::title($processor->lname)}}</td>
            <td>{{ Str::title($processor->fname)}}</td>
            <td>{{ Str::title($processor->department ? $processor->department->name : "N/A")}}</td>
            <td>{{ Str::title($processor->status)}}</td>
            <td>{{ Str::title(str_replace("_"," ",$processor->type))}}</td>
            <td>{{ Helper::date_format($processor->created_at)}}</td>
            <td >
              <button type="button" class="btn btn-sm p-0" data-toggle="dropdown" style="background-color: transparent;"> <i class="mdi mdi-dots-horizontal" style="font-size: 30px"></i></button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton2">
                <a class="dropdown-item" href="{{route('system.processor.edit',[$processor->id])}}">Edit {{ Str::title(str_replace("_"," ",$processor->type))}}</a>
                <a class="dropdown-item" href="{{route('system.processor.reset',[$processor->id])}}">Reset Password</a>
                <!-- <a class="dropdown-item action-delete"  data-url="{{route('system.processor.destroy',[$processor->id])}}" data-toggle="modal" data-target="#confirm-delete">Remove Record</a> -->
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center"><i>No Accounts Records Available.</i></td>
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