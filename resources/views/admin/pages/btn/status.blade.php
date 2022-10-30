@if($status == 1)
    <div class="btn btn-success">{{trans('datatable.active')}}</div>
@else
    <div class="btn btn-danger">{{trans('datatable.dis_active')}}</div>
@endif
