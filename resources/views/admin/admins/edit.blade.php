@extends('admin.layouts.app')

@section('page_title', trans('admin.adminEdit'))
@section('small_title', trans('admin.admins'))

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.adminEdit')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\AdminController@adminUpdate',$model->id],
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

                        <div class="form-group">
                            <label for="password">{{trans('admin.password')}}</label>
                            {!! Form::password('password', ['class' => 'form-control','placeholder' =>trans('admin.passwordplaceholder')]) !!}
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{trans('admin.password_confirmation')}}</label>
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>

                        



                        <div class="form-group">
                            <label for="image">{{trans('admin.image')}}</label>
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

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date" class="col-form-label">Start Date *</label>
                                <input type="date" class="form-control" id="start_date" value="{{$model->start_date}}"
                                       name="start_date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date" class="col-form-label">Start Date *</label>
                                <input type="date" class="form-control" id="end_date" value="{{$model->end_date}}"
                                       name="end_date" required>
                            </div>
                        </div>


{{--                        <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="name">{{trans('admin.roles')}}</label><br>--}}
{{--                                <input id="select-all" type="checkbox"><label for='select-all'>اختيار الكل</label>--}}
{{--                                <br>--}}
{{--                                <div class="row">--}}
{{--                                    @foreach($perm as $role)--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="checkbox">--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" name="roles[]" value="{{$role->id}}"--}}
{{--                                                           @if($model->hasRole($role->name))--}}
{{--                                                           checked="checked"--}}
{{--                                                        @endif--}}
{{--                                                    >--}}
{{--                                                    {{$role->name_ar}}--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

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
@push('js')
    <script>
        $("#select-all").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });
    </script>
@endpush
