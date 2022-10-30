@extends('admin.layouts.app')

@section('small_title')
    {{trans('admin.permission')}}
@endsection
@section('page_title')
    {{trans('admin.listPermission')}}
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
                   href="{{url(route('permission.create'))}}"
                   style="margin-bottom: 20px">
                    <i class="fa fa-plus-circle"></i> {{trans('admin.permissionCreate')}}
                </a>
            </div>


            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'dataTable table table-striped table-hover'], true) !!}
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    @push('js')

        {!! $dataTable->scripts() !!}

        <script type="text/javascript">
            $('.message-flash .alert').not('.alert-important').delay(2000).fadeOut(2000);
            $(document).ready(function () {
                $('.select5').select2();
            });
        </script>
    @endpush

@endsection
