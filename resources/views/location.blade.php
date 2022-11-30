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
</head>
<body>

<div class="jumbotron text-center">
    <h3 class="box-title">{{$model->name}}</h3>
</div>

<div class="container">
    <div class="row">

        <div class="col-sm-2"></div>
        <div class="col-sm-8">

            @if(isset($errorMessageDuration))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $errorMessageDuration }}
                </div>
            @endif


            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('getLocationSurvey')}}">
                @csrf

                @if($user &&$email)
                    <input type="hidden"  name="LAST_NAME" id="LAST_NAME" value="{{$user['data']['LAST_NAME']}}">
                    <input type="hidden"  name="EMPLOYEE_ID" id="EMPLOYEE_ID" value="{{$user['data']['EMPLOYEE_ID']}}">
                    <input type="hidden"  name="email" id="email" value="{{$email}}">
                @endif
                <div class="form-group">
                    @inject('locations', 'App\Models\Locations')
                    @if($locations->where('id','>', 0)->where('status', '1')->count() != 0)
                        <div class="form-group">
                            <h4>
                                <label for="location_id">{{trans('admin.location_id')}} *</label>
                            </h4>

                            <select class="form-control select2" id="location_id" required
                                    name="location_id">
                                <option value="">{{trans('admin.location_id')}}</option>
                                @foreach($locations->where('id','>', 0)->where('status', '1')->where('location_type', 'special')->get() as $location)
                                    <option
                                        value="{{$location->id}}">
                                        {{$location->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Next</button>
            </form>
            <div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>


</body>
</html>

