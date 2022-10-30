@extends('admin.layouts.app')
@inject('model', 'Spatie\Permission\Models\Role')
@section('page_title')
    {{trans('admin.roleCreate')}}
@endsection
@section('small_title')
    {{trans('admin.role')}}
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.roleCreate')}}</h3>
            </div>
            <div class="box-body">
                @include('partials.validations_errors')

                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Basic layout-->
                                <form action="{{ route('role.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="panel panel-flat">

                                        <div class="panel-body">

                                            @include('admin.roles.form')

                                            <div class="panel panel-flat">
                                                <input id="select-all" type="checkbox"><label for='select-all'> &nbsp; {{ trans('admin.select-all') }}</label>
                                            </div>


                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.role') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                            {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input  type="checkbox" name="plan[]" class="switchery" value="role.index" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.create') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="role.create" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="role.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.delete') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.admins.destroy" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.admins') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                            {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.admins" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.create') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.admins.create" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.admins.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.delete') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.admins.delete" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>



                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.users') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.users" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.create') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.users.create" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.users.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.delete') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.users.delete" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>




                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.categories') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.categories" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.create') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.categories.create" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.categories.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.delete') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.categories.delete" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.pages') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.pages" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.create') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.pages.create" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.pages.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.delete') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.pages.delete" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.places') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.places" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.create') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.places.create" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.places.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.delete') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.places.delete" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.car_types') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.car_types" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.create') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.car_types.create" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.car_types.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.delete') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.car_types.delete" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.providers') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.providers" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('datatable.show') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.providers.show" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('datatable.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.providers.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.orders') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.providers.orders" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.discount_codes') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.discount_codes" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.create') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.discount_codes.create" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.edit') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.discount_codes.edit" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.delete') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.discount_codes.delete" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>



                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.complaints') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.complaints" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('datatable.show') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.complaints.show" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>



                                            <div class="panel panel-flat">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title"> {{ trans('admin.orders') }} </h5>
                                                    <div class="heading-elements">
                                                        {{--<ul class="icons-list">--}}
                                                        {{--<li><a data-action="collapse"></a></li>--}}
                                                        {{--</ul>--}}
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('admin.list') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.orders" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-3"> {{ trans('datatable.show') }} </label>
                                                                <div class="col-lg-9">
                                                                    <div class="checkbox checkbox-switchery switchery-xs">
                                                                        <label>
                                                                            <input type="checkbox" name="plan[]" class="switchery" value="admin.orders.show" >
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>









                                            {{--// footer--}}
                                            <div class="text-right">
                                                <input type="submit" class="btn btn-primary" name="forward" value=" {{ trans('admin.create') }} " />
                                                <input type="reset" class="btn btn-warning" value=" {{ trans('admin.reset') }} " />
                                                <a href="{{ route('role.index') }}" class="btn btn-success">{{ trans('admin.back_to_menu') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
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