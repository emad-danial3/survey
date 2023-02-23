@extends('admin.layouts.app')
@inject('model', 'App\Models\Atr_policy')
@section('page_title')
    {{trans('admin.policyCreate')}}
@endsection
@section('small_title')
    {{trans('admin.policies')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.policyCreate')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\PolicyController@store'],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}


                        @inject('departments', 'App\Models\Department')
                        @if($departments->where('id','>', 0)->where('status', '1')->count() != 0)
                            <div class="form-group">
                                <label for="departments_id">{{trans('admin.departments_id')}} *</label>
                                <select class="form-control select2" id="departments_id" required
                                        name="departments_id">
                                    <option value="0">{{trans('admin.departments_id')}}</option>
                                    @foreach($departments->where('id','>', 0)->where('status', '1')->get() as $department)
                                        <option
                                            value="{{$department->id}}">
                                            {{$department->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif


                        <div class="form-group">
                            <label for="clause">Policy Clause</label>
                            {!! Form::text('clause', null , ['class' => 'form-control','required'=>'required' , 'placeholder'=>'Policy Clause']) !!}
                        </div>
                        <div class="form-group">
                            <label for="policy_name">Policy Name</label>
                            {!! Form::text('policy_name', null , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Name']) !!}
                        </div>
                        <div class="form-group">
                            <label for="policy_content">Policy Content</label>
                            {!! Form::text('policy_content', null , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Content']) !!}
                        </div>
                        <div class="form-group">
                            <label for="policy_page">Policy Page</label>
                            {!! Form::text('policy_page', null , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Page']) !!}
                        </div>
                        <div class="form-group">
                            <label for="policy_path">Policy Path</label>
                            {!! Form::text('policy_path', null , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Path']) !!}
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
