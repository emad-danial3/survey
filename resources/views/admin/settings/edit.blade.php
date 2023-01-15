@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.settings')}}
@endsection
@section('small_title')
    {{trans('admin.settings')}}
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.settings')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <div class="message-flash">
                        @include('flash::message')
                    </div>
                    @include('partials.validations_errors')
                    <div class="box-body">
                        <form action="{{route('settings.update')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field()}}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone">{{trans('admin.phone')}}</label>
                                    <input type="text" class="form-control" name="phone"
                                           placeholder="{{trans('admin.phone')}}"
                                           @if(isset($settings->phone)) value="{{$settings->phone}}" @endif>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="blog_email">{{trans('admin.email')}}</label>
                                    <input type="text" class="form-control" name="email"
                                           placeholder="{{trans('admin.email')}}"
                                           @if(isset($settings->email))  value="{{$settings->email}}" @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{trans('admin.question_options')}}</label>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="option_1">{{trans('admin.option_1')}}</label>
                                    <input type="text" class="form-control" name="option_1"
                                           placeholder="{{trans('admin.option_1')}}"
                                           @if(isset($settings->option_1))  value="{{$settings->option_1}}" @endif>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="option_2">{{trans('admin.option_2')}}</label>
                                    <input type="text" class="form-control" name="option_2"
                                           placeholder="{{trans('admin.option_2')}}"
                                           @if(isset($settings->option_2))  value="{{$settings->option_2}}" @endif>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="option_3">{{trans('admin.option_3')}}</label>
                                    <input type="text" class="form-control" name="option_3"
                                           placeholder="{{trans('admin.option_3')}}"
                                           @if(isset($settings->option_3))  value="{{$settings->option_3}}" @endif>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="option_4">{{trans('admin.option_4')}}</label>
                                    <input type="text" class="form-control" name="option_4"
                                           placeholder="{{trans('admin.option_4')}}"
                                           @if(isset($settings->option_4))  value="{{$settings->option_4}}" @endif>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="option_5">{{trans('admin.option_5')}}</label>
                                    <input type="text" class="form-control" name="option_5"
                                           placeholder="{{trans('admin.option_5')}}"
                                           @if(isset($settings->option_5))  value="{{$settings->option_5}}" @endif>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="text">{{trans('admin.text')}}</label>
                                <textarea name="text" class="form-control"
                                          placeholder="{{trans('admin.Enter Description')}}"
                                          rows="3"> @if(isset($settings->text))  {{$settings->text}} @endif</textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="whats_app">{{trans('admin.whats_app')}}</label>
                                    <input type="text" class="form-control" name="whats_app"
                                           placeholder="{{trans('admin.whats_app')}}"
                                           @if(isset($settings->whats_app)) value="{{$settings->whats_app}}" @endif>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="instagram">{{trans('admin.instagram')}}</label>
                                    <input type="text" class="form-control" name="instagram"
                                           placeholder="{{trans('admin.instagram')}} "
                                           @if(isset($settings->instagram)) value="{{$settings->instagram}}" @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="you_tube">{{trans('admin.you_tube')}}</label>
                                    <input type="text" class="form-control" name="you_tube"
                                           placeholder="{{trans('admin.you_tube')}}"
                                           @if(isset($settings->you_tube)) value="{{$settings->you_tube}}" @endif>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="twitter">{{trans('admin.twitter')}}</label>
                                    <input type="text" class="form-control" name="twitter"
                                           placeholder="{{trans('admin.twitter')}}"
                                           @if(isset($settings->twitter)) value="{{$settings->twitter}}" @endif>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="facebook">{{trans('admin.facebook')}}</label>
                                    <input type="text" class="form-control" name="facebook"
                                           placeholder="{{trans('admin.facebook')}}"
                                           @if(isset($settings->facebook)) value="{{$settings->facebook}}" @endif>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image">{{trans('admin.image_site')}}</label>
                                    <input type="file" class="form-control-file" name="image">
                                    @if(isset($settings->image))
                                        <img src="{{asset($settings->image)}}" alt="000000" class="img-thumbnail"
                                             width="50px" height="50px">
                                    @endif
                                </div>

                            </div>





                            <button type="submit" class="btn btn-primary btn-lg">{{trans('admin.edit')}}</button>
                        </form>
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
            $('.message-flash .alert').not('.alert-important').delay(2000).fadeOut(2000);
        })
    </script>
@endpush
