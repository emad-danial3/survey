@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.Posts')}}
@endsection
@section('small_title')
    {{trans('admin.Posts')}}
@endsection
@section('content')
    <div class="box">

        @include('partials.validations_errors')

        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.Posts')}}</h3>
        </div>
        <div class="box-body">
            @if(count($orders))
                <div class="box">

                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            @include('flash::message')
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>{{trans('admin.title')}}</th>

                                                <th>{{trans('admin.status')}}</th>

                                                <th>{{trans('datatable.show')}}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $record)
                                                <tr id="removable{{$record->id}}">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$record->title}}</td>
                                                    <td>{{$record->status}}</td>


                                                    <td class=" text-center">
                                                        <a class="btn btn-primary"
                                                           href="{{ route('admin.posts.show',$record->id) }}"
                                                           role="button"><i class="fa fa-eye"></i></a>
                                                    </td>


                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                {{--<div class="text-center">{{$orders->links()}}</div>--}}
            @else
                <div class="alert alert-danger">
                    No Data
                </div>
            @endif
        </div>

    </div>

    @push('js')

        <script type="text/javascript">
            $('.message-flash .alert').not('.alert-important').delay(2000).fadeOut(2000);
            $(document).ready(function () {
                $('.select5').select2();
            });
        </script>
    @endpush

@endsection

