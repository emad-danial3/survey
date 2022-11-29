@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.locationEdit')}}
@endsection
@section('small_title')
    {{trans('admin.locations')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.locationEdit')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\LocationController@locationUpdate',$model->id],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}


                        <div class="form-group">
                            <label for="name">{{trans('admin.name')}}</label>
                            {!! Form::text('name', $model->name , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="status">Location Type</label>
                            <select name="location_type" class="form-control">
                                <option {{old('location_type',$model->location_type)=="special"? 'selected':''}} value="special">خاص اساسي</option>
                                <option {{old('location_type',$model->location_type)=="general"? 'selected':''}}  value="general"> عام ( مثل الرووف )</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Area </label>
                            <select name="area" class="form-control">
                                <option {{old('area',$model->area)=="other"? 'selected':''}}  value="other">خارج الاوبرا</option>
                                <option {{old('area',$model->area)=="opera"? 'selected':''}} value="opera">مبني الاوبرا</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">{{trans('admin.status')}}</label>

                            <select name="status" class="form-control">
                                <option {{old('status',$model->status)=="0"? 'selected':''}}  value="0">No Active</option>
                                <option {{old('status',$model->status)=="1"? 'selected':''}} value="1">Active</option>
                            </select>
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

@push('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
