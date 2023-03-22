@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.questionEdit')}}
@endsection
@section('small_title')
    {{trans('admin.questions')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.questionEdit')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\QuestionController@questionUpdate',$model->id],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}





                        @inject('categories', 'App\Models\Category')
                        @if($categories->where('id','>', 0)->where('status', '1')->count() != 0)
                            <div class="form-group">
                                <label for="category_id">{{trans('admin.category_id')}} *</label>
                                <select class="form-control select2" id="category_id" required
                                        name="category_id">
                                    <option value="0">{{trans('admin.category_id')}}</option>
                                    @foreach($categories->where('id','>', 0)->where('status', '1')->get() as $category)
                                        <option
                                            value="{{$category->id}}" @if ($category->id ==  $model->category_id) selected @endif>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif



                        @push('scripts')
                            <script>
                                CKEDITOR.replace('question_title');
                            </script>
                        @endpush


                        <div class="form-group col-md-12" id="questions_container_body">
                            <div  id="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="question_title">Question Title</label>

                                        {!! Form::textarea('question_title', $model->title , ['class' => 'form-control', 'required' => 'required']) !!}

                                    </div>
                                    <div class="col-md-2">

                                        <label for="question_type">Question Type</label>
                                        <select id="question_type" name="question_type" class="form-control">
                                            <option value="choice" @if ( $model->type =='choice') selected @endif>Choice</option>
                                            <option value="article" @if ( $model->type =='article') selected @endif>Article</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="question_required">Question Required ?</label>
                                        <select id="question_required" name="question_required" class="form-control">
                                            <option value="1"  @if ( $model->required =='1') selected @endif>Yes</option>
                                            <option value="0" @if ( $model->required =='0') selected @endif>No</option>
                                        </select>
                                    </div>

                                    @if($model->type =='choice')
                                    <div class="col-md-12 row" id="questions_options_container">
                                        <div class="col-md-12">
                                            <h4>
                                                <label>Options</label>
                                            </h4>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="question_option_1">Option 1</label><br>
                                            <label for="question_option_1">{{$question_options['option_1']}}</label>

                                              </div>
                                        <div class="col-md-3">
                                            <label for="question_option_2">Option 2</label><br>
                                            <label for="question_option_2">{{$question_options['option_2']}}</label>



                                        </div>
                                        <div class="col-md-3">

                                            <label for="question_option_3">Option 3</label><br>
                                            <label for="question_option_3">{{$question_options['option_3']}}</label>


                                        </div>

                                        <div class="col-md-3">
                                            <label for="question_option_5">Option 5</label><br>
                                            <label for="question_option_5">{{$question_options['option_5']}}</label>


                                        </div>
                                    </div>
                                    @endif
                                </div>


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

@push('js')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush
