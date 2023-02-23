@extends('admin.layouts.app')

@section('page_title', trans('admin.roleEdit'))
@section('small_title', trans('admin.role'))

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.roleEdit')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('flash::message')
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\PolicyController@update',$model->id],
                            'method' =>'put',
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
                                            value="{{$department->id}}"
                                        @if($department->id  == $model->departments_id) selected @endif>
                                            {{$department->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="clause">Policy Clause</label>
                            {!! Form::text('clause', $model->clause , ['class' => 'form-control','required'=>'required' , 'placeholder'=>'Policy Clause']) !!}
                        </div>
                        <div class="form-group">
                            <label for="policy_name">Policy Name</label>
                            {!! Form::text('policy_name', $model->policy_name , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Name']) !!}
                        </div>
                        <div class="form-group">
                            <label for="policy_content">Policy Content</label>
                            {!! Form::text('policy_content', $model->policy_content , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Content']) !!}
                        </div>
                        <div class="form-group">
                            <label for="policy_page">Policy Page</label>
                            {!! Form::text('policy_page', $model->policy_page , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Page']) !!}
                        </div>
                        <div class="form-group">
                            <label for="policy_path">Policy Path</label>
                            {!! Form::text('policy_path', $model->policy_path , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Path']) !!}
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
    $("#select-all").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
    });
</script>
@endpush
