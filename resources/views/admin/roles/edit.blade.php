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
                            'action' => ['Admin\RoleController@update',$model->id],
                            'method' =>'put',
                        ]) !!}




                        <div class="form-group">
                            <label for="name">{{trans('admin.name_en')}}</label>
                            <input type="text" class="form-control" name="role_en" value="{{ $model->role_en }}" placeholder="{{trans('admin.name_en')}}" >
                        </div>


                        <div class="form-group">
                            <label for="name">{{trans('admin.name_ar')}}</label>
                            <input type="text" class="form-control" name="role_ar" value="{{ $model->role_ar }}" placeholder="{{trans('admin.name_ar')}}" >
                        </div>


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
                                                        <input  type="checkbox" name="plan[]" class="switchery"  @if(in_array('permission.index', $permission->plan)) checked @endif value="role.index" >
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
