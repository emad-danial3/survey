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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            Employee Name : {{$user->name}}
                                        </div>
                                        <div class="col-sm-6">
                                           Location Name : {{$location->name}}
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                    <table class="table table-bordered table-striped arabicStyle">
                                            <thead>
                                            <tr role="row">

{{--                                                <th>{{trans('admin.title')}}</th>--}}

{{--                                                <th>{{trans('admin.status')}}</th>--}}
                                                <th  class="arabicStyle"> ?? </th>
                                                <th  class="arabicStyle"> ???????? ?????????????? ?????????? </th>
                                                <th  class="arabicStyle" colspan="4">
                                                    <table class="table " style="margin-bottom: 0px">
                                                        <tr>
                                                            <th colspan="4" class="text-center"> ?????? ?????????? ?????????? ????????????????????</th>
                                                        </tr>
                                                        <tr>
                                                            <th  class="arabicStyle">{{$question_options['option_1']}}</th>
                                                            <td>{{$question_options['option_2']}}</td>
                                                            <td>{{$question_options['option_3']}}</td>
                                                            <td>{{$question_options['option_4']}}</td>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="arabicStyle">TOTAL</th>
                                                <th class="arabicStyle">{{$question_options['option_1']}}</th>
                                                <th class="arabicStyle">{{$question_options['option_2']}}</th>
                                                <th class="arabicStyle">{{$question_options['option_3']}}</th>
                                                <th class="arabicStyle">{{$question_options['option_4']}}</th>
                                                <th class="arabicStyle">SUM</th>
                                            </tr>
                                            </thead>
                                            <tbody >

                                            @foreach($usersMakeSurveyQuestions as $record)
                                                <tr >
                                                    <td>{{$loop->iteration}}</td>
                                                    <td class="text-right"> {!! $record->title !!} </td>
                                                    <td class="text-center"> {{$record->option_1_count}} </td>
                                                    <td class="text-center"> {{$record->option_2_count}} </td>
                                                    <td class="text-center"> {{$record->option_3_count}} </td>
                                                    <td class="text-center"> {{$record->option_4_count}} </td>
                                                    <td class="text-center"> {{$record->total_count}} </td>
                                                    <td class="text-center"> {{$record->total_option_1_percent}}   % </td>
                                                    <td class="text-center"> {{$record->total_option_2_percent}}   % </td>
                                                    <td class="text-center"> {{$record->total_option_3_percent}}   % </td>
                                                    <td class="text-center"> {{$record->total_option_4_percent}}   % </td>
                                                    <td class="text-center"> {{$record->total_percentage}}  % </td>


                                                </tr>
                                            @endforeach

                                            <tr >
                                                <th colspan="2" class="text-center" style="background-color: #ffdf02">????????????????</th>
                                                <th class="text-center"> {{$sum_option_1_count}} </th>
                                                <th class="text-center"> {{$sum_option_2_count}} </th>
                                                <th class="text-center"> {{$sum_option_3_count}} </th>
                                                <th class="text-center"> {{$sum_option_4_count}} </th>
                                                <th class="text-center">  </th>
                                                <th colspan="4" class="text-center" style="background-color: #bdd8fc">?????????? ?????????? ????????????</th>
                                                <th class="text-center" style="color: #d9252b;background-color: #bdd8fc"> {{$final_total_sum_percentage}} % </th>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <h3>Answer Questions Articles </h3>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Question ID</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Question Title</th>
                                            <th scope="col">Answer</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($usersMakeSurveyOptinalQuestions as $record)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$record->question_id}}</td>
                                                <td>{{$record->category_name}}</td>
                                                <td>{!! $record->title !!} </td>
                                                <td>{!! $record->answer !!} </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
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

