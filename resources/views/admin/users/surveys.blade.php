@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.statistics')}}
@endsection
@section('small_title')
    {{trans('admin.statistics')}}
@endsection
@section('content')
    <div class="box">

        @include('partials.validations_errors')

        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin.statistics')}}</h3>
        </div>
        <div class="box-body">
            @if(count($surveys))
                <div class="box">

                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            @include('flash::message')
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">


                                        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('admin/getUserStatistic')}}">
                                            @csrf
                                            <input type="hidden"  name="user_id" id="user_id" value="{{$user->id}}">
                                            <input type="hidden"  name="location_id" id="location_id" value="{{$user->location_id}}">
                                            <div class="form-group">

                                                <select class="form-control select2" id="page_id" required
                                                        name="page_id">
                                                    <option value="">{{trans('admin.pages')}}</option>
                                                    @foreach($surveys as $survey)
                                                        <option
                                                            value="{{$survey->id}}"  @if($lastSurveyId == $survey->id) selected @endif  >
                                                            {{$survey->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        <button type="submit" class="btn btn-primary ">Search</button>

                                        </form>
                                    </div>
<br>
<br>

                                </div>
                            </div>
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

{{--                                            @foreach($surveys as $record)--}}
{{--                                                <tr id="removable{{$record->id}}">--}}
{{--                                                    <td>{{$loop->iteration}}</td>--}}
{{--                                                    <td>{{$record->title}}</td>--}}
{{--                                                    <td>{{$record->status}}</td>--}}


{{--                                                    <td class=" text-center">--}}
{{--                                                        <a class="btn btn-primary"--}}
{{--                                                           href="{{ route('admin.posts.show',$record->id) }}"--}}
{{--                                                           role="button"><i class="fa fa-eye"></i></a>--}}
{{--                                                    </td>--}}


{{--                                                </tr>--}}
{{--                                            @endforeach--}}

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                {{--<div class="text-center">{{$surveys->links()}}</div>--}}
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

