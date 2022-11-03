@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.reports')}}
@endsection
@section('small_title')
    {{trans('admin.reports')}}
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            @include('partials.validations_errors')
            <div class="message-flash">
                @include('flash::message')
            </div>
           

            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap' , 'id' => 'datatable5'], true) !!}
            </div>
        </div>
    </div>

    <style>
        .dataTables_filter {
            float: left;
        }
    </style>
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

