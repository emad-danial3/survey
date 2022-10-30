@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.userEdit')}}
@endsection
@section('small_title')
    {{trans('admin.users')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.userEdit')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\UserController@userUpdate',$model->id],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}


                        <div class="form-group">
                            <label for="name">{{trans('admin.name')}}</label>
                            {!! Form::text('name', null , ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">{{trans('admin.email')}}</label>
                            {!! Form::email('email', null , ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="mobile">{{trans('admin.mobile')}}</label>
                            {!! Form::text('mobile', null , ['class' => 'form-control']) !!}
                        </div>



                        @inject('locations', 'App\Models\Locations')
                        @if($locations->where('id','>', 0)->where('status', '1')->count() != 0)
                            <div class="form-group">
                                <label for="location_id">{{trans('admin.location_id')}} *</label>
                                <select class="form-control select2" id="location_id" required
                                        name="location_id">
                                    <option value="0">{{trans('admin.location_id')}}</option>
                                    @foreach($locations->where('id','>', 0)->where('status', '1')->get() as $location)
                                        <option
                                            value="{{$location->id}}" @if($location->id == $model->location_id) selected @endif>
                                            <td>{{$location->name}}</td>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="image">Profile {{trans('admin.image')}}</label>
                            <input type="file" class="form-control-file" name="image">
                            @if ($model->image != null)
                                <img src="{{url($model->image)}}" alt="000000" class="img-thumbnail"
                                     width="50px" height="50px">
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="gender">{{trans('admin.gender')}} *</label>
                            <div class="form-control row">
                                <input type="radio" id="gender" name="gender" class="male"  @if($model->gender == 'male') checked @else @endif required
                                       value="male"> {{trans('admin.male')}}
                                <input type="radio" id="gender" name="gender" class="female" @if($model->gender == 'female') checked @else @endif style="@if(direction() == 'ltr') margin-left: 30px; @else margin-right: 30px; @endif" required
                                       value="female"> {{trans('admin.female')}}
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{trans('admin.submit')}}</button>
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
