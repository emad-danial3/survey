@extends('admin.layouts.app')

@section('page_title')

@endsection
@section('small_title')

    {{trans('admin.Dashboard')}}
@endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- ./col -->
{{--                <div class="col-lg-3 col-6">--}}
{{--                    <!-- small box -->--}}
{{--                    <div class="small-box bg-success">--}}
{{--                        <div class="inner">--}}
{{--                            <h3>53%</h3>--}}


{{--                            <p>{{trans('admin.Bounce Rate')}}</p>--}}
{{--                        </div>--}}
{{--                        <div class="icon">--}}
{{--                            <i class="ion ion-stats-bars"></i>--}}
{{--                        </div>--}}
{{--                        <a href="{{ url('admin/users') }}" class="small-box-footer">--}}
{{--                            <i class="fa fa-arrow-circle-o-right"></i> {{trans('admin.More Info')}} </a>--}}

{{--                    </div>--}}
{{--                </div>--}}
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $categoriesCount }}</h3>

                            <p>{{trans('admin.categories')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion-ios-albums-outline"></i>
                        </div>
                        <a href="{{ url('admin/categories') }}" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> {{trans('admin.More Info')}} </a>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $questionsCount }}</h3>

                            <p>{{trans('admin.questions')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ url('admin/questions') }}" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> {{trans('admin.More Info')}} </a>

                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $userCount }}</h3>


                            <p>{{trans('admin.users')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="{{ url('admin/users') }}" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> {{trans('admin.More Info')}} </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ $departmentsCount }}</h3>


                            <p>{{trans('admin.departments')}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="{{ url('admin/departments') }}" class="small-box-footer">
                            <i class="fa fa-arrow-circle-o-right"></i> {{trans('admin.More Info')}} </a>
                    </div>
                </div>
                <!-- ./col -->


            </div>
            <div class="row">


                <div class="col-lg-3 col-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-paper-plane"></i></span>

                        <div class="info-box-content">
                            <h3 class="info-box-text" style="margin-top: 5px; ">{{trans('admin.pages')}}</h3>
                            <span class="info-box-number">{{ $surveyCount }}</span>
                            <a href="{{ url('admin/pages') }}">
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>


            </div>

        </div><!-- /.container-fluid -->
    </section>

@endsection
