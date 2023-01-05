<!DOCTYPE html>
<html lang="en">
<head>
    <title> Survey Web Site</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .category_name{
            text-align: center;
            border-radius: 7px;
            background-color: rgb(123, 55, 10);
            color: rgba(255, 255, 255, 1);
            padding: 12px 24px;
        }
        .card{
            border: 1px solid #ddd;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .user_name{
            max-width: 350px;
            width: 350px;
            overflow: hidden
        }
        .this_option{
            width: 20px;
            height: 20px;
        }
        .specific_input,.specific_input:focus{
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
        }


    </style>
</head>
<body>

<div class="jumbotron text-center">
    <h3 class="box-title">{{$model->name}}</h3>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">

                        @if($page_question)


                                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('saveSurvey')}}">
                                    @csrf
                                    @if($model)
                                        <input type="hidden"  name="LAST_NAME" id="LAST_NAME" value="{{$LAST_NAME}}">
                                        <input type="hidden"  name="EMPLOYEE_ID" id="EMPLOYEE_ID" value="{{$EMPLOYEE_ID}}">
                                        <input type="hidden"  name="EMAIL_ADDRESS" id="EMAIL_ADDRESS" value="{{$EMAIL}}">
                                        <input type="hidden"  name="location_id" id="location_id" value="{{$location_id}}">
                                        <input type="hidden"  name="survey_id" id="survey_id" value="{{$model->id}}">
                                    @endif

                                @foreach($page_question as $key=>$category)
                                <div class="row">

                                    <div class="col-md-12 category_name">
                                        <h3 class="box-title">{{$category['category']['name']}} - {{$category['location']['name']}}</h3>
                                    </div>

                                </div>
                                @if($category['category']['questions'] && count($category['category']['questions'])>0)
                                    @foreach($category['category']['questions'] as $ind=>$question)
                                        @if($question['type'] == 'choice')
                                           <div class="row">

                                            <div class="col-md-12 card">
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
                                                            <tr>
                                                                <th scope="row" class="user_name">{{$user['user']['name']}}</th>
                                                                <td class="text-center"><input type="radio" class="this_option" name="{{$question['id']}}-{{$user['user']['id']}}" value="option_1" @if($question['required'] == '1') required @endif >  </td>
                                                                <td class="text-center"><input type="radio" class="this_option"  name="{{$question['id']}}-{{$user['user']['id']}}" value="option_2">  </td>
                                                                <td class="text-center"><input type="radio" class="this_option"  name="{{$question['id']}}-{{$user['user']['id']}}" value="option_3">  </td>
                                                                <td class="text-center"><input type="radio" class="this_option"  name="{{$question['id']}}-{{$user['user']['id']}}" value="option_4"> </td>
                                                            </tr>

                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        @else
                                                    <div class="row">

                                                        <div class="col-md-12 card">
                                                            <br>
                                                            <div  style="display: flex;"> {!! $question['title'] !!}  @if($question['required'] == '1') <span style="color: #d93025">  &nbsp; *  </span> @endif</div>
                                                            <br>
                                                            <div>
<input type="text" class="form-control specific_input" placeholder="Your answer"  name="{{$question['id']}}"  @if($question['required'] == '1') required @endif >
                                                            <br>
                                                            <br>
                                                            </div>
                                                        </div>

                                                    </div>
                                        @endif


                                    @endforeach
                                @endif
                            @endforeach
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8 ">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                    </div>


                                </form>

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

    </div>
</div>

</body>
</html>
