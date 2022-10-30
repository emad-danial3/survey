@extends('admin.layouts.app')
@inject('model', 'App\Models\Category')
@section('page_title')
    {{trans('admin.categoryCreate')}}
@endsection
@section('small_title')
    {{trans('admin.categories')}}
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.categoryCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\CategoryController@categoryStore'],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}



                        <div class="form-group">
                            <label for="name">{{trans('admin.name')}}</label>
                            {!! Form::text('name', null , ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="status">{{trans('admin.status')}}</label>

                            <select name="status" class="form-control">
                                <option {{old('status',$model->status)=="1"? 'selected':''}} value="1">Active</option>
                                <option {{old('status',$model->status)=="0"? 'selected':''}}  value="0">No Active</option>

                            </select>
                        </div>




                        <div class="form-group">
                            <label for="img">{{trans('admin.img')}}</label>
                            <input type="file" class="form-control" name="img" >
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
