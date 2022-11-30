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
            <div class="box-header with-border text-center">
                  <h3 class="box-title">{{$model->name}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">

                        @if($page_question)
                            @foreach($page_question as $key=>$category)
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-8" style="text-align: center;border-radius: 7px;background-color: rgb(123, 55, 10); color: rgba(255, 255, 255, 1);padding: 12px 24px;">
                                       @if($category['category'])
                                            <h3 class="box-title">{{$category['category']['name']}} - {{$category['location']['name']}}</h3>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                @if($category['category'] && $category['category']['questions'] && count($category['category']['questions'])>0)
                                    @foreach($category['category']['questions'] as $ind=>$question)
                                        @if($question['type'] == 'choice')
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-8" style="border: 1px solid #ddd;border-radius: 15px;margin-bottom: 30px;">
                                                <table class="table table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" colspan="5"> {!! $question['title'] !!} </th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" > </th>
                                                        @if($question_options && count($question_options)>0)
                                                            <th scope="col">{{ $question_options['option_1'] }}</th>
                                                            <th scope="col">{{ $question_options['option_2'] }}</th>
                                                            <th scope="col">{{ $question_options['option_3'] }}</th>
                                                            <th scope="col">{{ $question_options['option_4'] }}</th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @if($category['users'] && count($category['users'])>0)
                                                        @foreach($category['users'] as $induser=>$user)
                                                            <tr>
                                                                <th scope="row" style="max-width: 350px;width: 350px;overflow: hidden">{{$user['user']['name']}}</th>
                                                                <td><input type="radio"  name="{{$question['id']}}-{{$user['user']['id']}}" value="جيد" disabled>  </td>
                                                                <td><input type="radio"  name="{{$question['id']}}-{{$user['user']['id']}}" value="متوسط" disabled>  </td>
                                                                <td><input type="radio"  name="{{$question['id']}}-{{$user['user']['id']}}" value="ضعيف" disabled>  </td>
                                                                <td><input type="radio"  name="{{$question['id']}}-{{$user['user']['id']}}" value="N/A" disabled> </td>
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
                                                        <input type="text" class="form-control specific_input" placeholder="Your answer"   disabled name="{{$question['id']}}"  @if($question['required'] == '1') required @endif >
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
