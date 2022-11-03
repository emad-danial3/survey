@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.pageShow')}}
@endsection
@section('small_title')
    {{trans('admin.pages')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">User LAST_NAME</th>
                    <th scope="col">{{$model->LAST_NAME}}</th>
                </tr>
                <tr>
                    <th scope="col">User EMAIL ADDRESS</th>
                    <th scope="col">{{$model->EMAIL_ADDRESS}}</th>
                </tr>
                <tr>
                    <th scope="col">User EMPLOYEE ID</th>
                    <th scope="col">{{$model->EMPLOYEE_ID}}</th>
                </tr>
                <tr>
                    <th scope="col">Survey Title</th>
                    <th scope="col">{{$model->survey->name}}</th>
                </tr>
                </thead>
            </table>

              <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')

                    <div class="box-body">

                        @if($page_question)

                                @foreach($page_question as $key=>$category)
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8 category_name">
                                            <h3 class="box-title">{{$category['category']['name']}}</h3>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>
                                    @if($category['category']['questions'] && count($category['category']['questions'])>0)
                                        @foreach($category['category']['questions'] as $ind=>$question)
                                            @if($question['type'] == 'choice')
                                                <div class="row">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-8 card">
                                                        <table class="table table-borderless">
                                                            <thead>
                                                            <tr >
                                                                <th scope="col" colspan="5" style="display: flex;"> {!! $question['title'] !!}  @if($question['required'] == '1') <span style="color: #d93025">  &nbsp; *  </span> @endif</th>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col" > </th>
                                                                @if($question_options && count($question_options)>0)
                                                                    <th scope="col" class="text-center">{{ $question_options['option_1'] }}</th>
                                                                    <th scope="col" class="text-center">{{ $question_options['option_2'] }}</th>
                                                                    <th scope="col" class="text-center">{{ $question_options['option_3'] }}</th>
                                                                    <th scope="col" class="text-center">{{ $question_options['option_4'] }}</th>
                                                                @endif
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @if($category['users'] && count($category['users'])>0)
                                                                @foreach($category['users'] as $induser=>$user)
{{--                                                                    @if($UsersSurveysDetails && count($UsersSurveysDetails)>0)--}}
{{--                                                                        @foreach($UsersSurveysDetails as $iii=>$uudd)--}}
{{--                                                                            @if($question['id'] == $uudd['question_id'] && $user['user_id'] == $uudd['user_id'] )--}}
{{--                                                                                --}}
{{--                                                                            @endif--}}
{{--                                                                        @endforeach--}}
{{--                                                                    @endif--}}
                                                                    <tr>
                                                                        <th scope="row" class="user_name">{{$user['user']['name']}}</th>
                                                                        <td class="text-center"><input type="radio" class="this_option" name="{{$question['id']}}-{{$user['user']['id']}}" value="option_1" @if($question['required'] == '1') required @endif  disabled>  </td>
                                                                        <td class="text-center"><input type="radio" class="this_option"  name="{{$question['id']}}-{{$user['user']['id']}}" value="option_2" disabled>  </td>
                                                                        <td class="text-center"><input type="radio" class="this_option"  name="{{$question['id']}}-{{$user['user']['id']}}" value="option_3" disabled>  </td>
                                                                        <td class="text-center"><input type="radio" class="this_option"  name="{{$question['id']}}-{{$user['user']['id']}}" value="option_4" disabled> </td>
                                                                    </tr>

                                                                @endforeach
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-8 card">
                                                        <br>
                                                        <div  style="display: flex;"> {!! $question['title'] !!}  @if($question['required'] == '1') <span style="color: #d93025">  &nbsp; *  </span> @endif</div>
                                                        <br>
                                                        <div>
                                                            <input type="text" class="form-control specific_input" placeholder="Your answer"  name="{{$question['id']}}"  @if($question['required'] == '1') required @endif  disabled>
                                                            <br>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                </div>
                                            @endif


                                        @endforeach
                                    @endif
                                @endforeach



                        @else
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8 ">
                                    <h3 class="box-title">No Data</h3>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        @endif

                    </div>


                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
