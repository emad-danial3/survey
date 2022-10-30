@extends('admin.layouts.app')

@section('small_title')
    {{trans('admin.role')}}
@endsection
@section('page_title')
    {{trans('admin.listRole')}}
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            @include('partials.validations_errors')
            <div class="message-flash">
                @include('flash::message')
            </div>
            <div class="col-xl-4">
                <a class="btn btn-success btn-md waves-effect waves-light mb-3"
                   href="{{url(route('role.create'))}}"
                   style="margin-bottom: 20px">
                    <i class="fa fa-plus-circle"></i> {{trans('admin.roleCreate')}}
                </a>
            </div><!-- end col -->

            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'dataTable table table-striped table-hover', 'id' => 'datatable_role'], true) !!}
            </div>
        </div>
        <!-- /.box-body -->
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
@endsection
