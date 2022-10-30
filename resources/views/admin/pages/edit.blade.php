@extends('admin.layouts.app')
@section('page_title')
    {{trans('admin.pageEdit')}}
@endsection
@section('small_title')
    {{trans('admin.pages')}}
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.pageEdit')}}</h3>
            </div>
            <div class="box-body">
                <div class="box">
                    @include('partials.validations_errors')
                    <div class="box-body">
                        {!! Form::model($model, [
                            'action' => ['Admin\PageController@pageUpdate',$model->id],
                            'method' =>'post',
                            'files' =>true,
                        ]) !!}

                        <input id="page_id" value="{{$model->id}}"  type="hidden">
                        <div class="form-group col-md-6">
                            <label for="name">{{trans('admin.name')}}</label>
                            {!! Form::text('name', $model->name , ['class' => 'form-control', 'required' => 'required','id'=>'main_page_title']) !!}
                        </div>

                        <div class="form-group col-md-3">
                            <label for="date">{{trans('admin.from_date')}}</label>
                            {!! Form::date('date', $model->from_date , ['class' => 'form-control', 'required' => 'required','id'=>'date']) !!}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="to_date">{{trans('admin.to_date')}}</label>
                            {!! Form::date('to_date', $model->to_date , ['class' => 'form-control', 'required' => 'required','id'=>'to_date']) !!}
                        </div>


                        <h4>
                            <label> Locations/Categories/Users</label>
                        </h4>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Location</th>
                                <th scope="col">Category</th>
                                <th scope="col">Users</th>


                            </tr>
                            </thead>
                            <tbody>

                            @if($page_question)
                                @foreach($page_question as $key=>$question)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$question['location']['name']}}</td>
                                        <td>{{$question['category']['name']}}</td>
                                        <td>
                                                    @if($question['users'])
                                                        @foreach($question['users'] as $index=>$user)
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <p>   {{$user['user']['name']}} </p>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button type="button" class="btn btn-primary " data-toggle="modal"
                                                                            onclick="goToSetValus({{$question['id']}},{{$question['location_id']}},{{$question['category_id']}},{{$user['user']['id']}})"
                                                                            data-target="#exampleModal">Edit
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button type="button" class="btn btn-danger"
                                                                            onclick="deleteConfirmation({{$question['id']}},{{$user['user']['id']}})">Delete
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-10">

                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-info "  data-toggle="modal"  data-target="#addNewExampleModal"> +  <i class="fa fa-user"></i>  Add User</a>
                            </div>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"> Finish & {{trans('admin.submit')}}</button>
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <!-- /.box -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 ">
                                @inject('locations', 'App\Models\Locations')
                                @if($locations->where('id','>', 0)->where('status', '1')->count() != 0)
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="location_id">{{trans('admin.location_id')}} *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control  col-md-12" id="location_id" required
                                                    name="location_id">
                                                <option value="0">{{trans('admin.location_id')}}</option>
                                                @foreach($locations->where('id','>', 0)->where('status', '1')->get() as $location)
                                                    <option
                                                        value="{{$location->id}}">
                                                        <td>{{$location->name}}</td>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 ">
                                @inject('categories', 'App\Models\Category')
                                @if($categories->where('id','>', 0)->where('status', '1')->count() != 0)
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <label for="category_id">{{trans('admin.category_id')}} *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control  " id="category_id" required
                                                    name="category_id">
                                                <option value="0">{{trans('admin.category_id')}}</option>
                                                @foreach($categories->where('id','>', 0)->where('status', '1')->get() as $category)
                                                    <option
                                                        value="{{$category->id}}">
                                                        {{$category->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                @inject('users', 'App\User')
                                @if($users->where('id','>', 0)->where('status', 'active')->count() != 0)
                                    <div class="form-group ">
                                        <label for="user_id">Chose {{trans('admin.user_id')}} </label>

                                        <select class="form-control " id="selected_user" required
                                                name="users">
                                            <option value="">Chose User</option>
                                            @foreach($users->where('id','>', 0)->where('status', 'active')->where('user_type', 'worker') ->get() as $user)
                                                <option
                                                    value="{{$user->id}}">
                                                    {{$user->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_chang_user">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNewExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 ">
                                @inject('locations', 'App\Models\Locations')
                                @if($locations->where('id','>', 0)->where('status', '1')->count() != 0)
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="location_new_id">{{trans('admin.location_id')}} *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control  col-md-12" id="location_new_id" required
                                                    name="location_new_id">
                                                <option value="0">{{trans('admin.location_id')}}</option>
                                                @foreach($locations->where('id','>', 0)->where('status', '1')->get() as $location)
                                                    <option
                                                        value="{{$location->id}}">
                                                        <td>{{$location->name}}</td>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 ">
                                @inject('categories', 'App\Models\Category')
                                @if($categories->where('id','>', 0)->where('status', '1')->count() != 0)
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <label for="category_new_id">{{trans('admin.category_id')}} *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control  " id="category_new_id" required
                                                    name="category_new_id">
                                                <option value="0">{{trans('admin.category_id')}}</option>
                                                @foreach($categories->where('id','>', 0)->where('status', '1')->get() as $category)
                                                    <option
                                                        value="{{$category->id}}">
                                                        {{$category->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                @inject('users', 'App\User')
                                @if($users->where('id','>', 0)->where('status', 'active')->count() != 0)
                                    <div class="form-group ">
                                        <label for="user_id">Chose {{trans('admin.user_id')}} </label>

                                        <select class="form-control " id="selected_new_user" required
                                                name="users">
                                            <option value="">Chose User</option>
                                            @foreach($users->where('id','>', 0)->where('status', 'active')->where('user_type', 'worker') ->get() as $user)
                                                <option
                                                    value="{{$user->id}}">
                                                    {{$user->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_new_user">Add User</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection

@push('js')
    <script>
        var edituser = '';
        var oldedituser = '';
        var base_url = window.location.origin;
        $(document).ready(function () {
            $('.select2').select2();
            var base_url = window.location.origin;


            $("#save_chang_user").click(function () {

                let location_id = $("#location_id").val();
                let category_id = $("#category_id").val();
                let selected_user = $("#selected_user").val();
                let formData = new FormData();
                formData.append('id', edituser);
                formData.append('location_id', location_id);
                formData.append('category_id', category_id);
                formData.append('user_id', selected_user);
                formData.append('old_user_id', oldedituser);

                let path = base_url + "/admin/saveUpdateUser";
                if (edituser > 0 && oldedituser>0) {
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (response) {
                            $('#exampleModal').modal('hide');
                            if (response.data.id) {
                                swal({
                                    position: 'top-end',
                                    type: "success",
                                    title: ' User has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(function () {
                                    window.location.reload(1);
                                }, 2000);

                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
                }


            });

            $("#save_new_user").click(function () {

                let location_new_id = $("#location_new_id").val();
                let page_id = $("#page_id").val();
                let category_new_id = $("#category_new_id").val();
                let selected_new_user = $("#selected_new_user").val();
                let formData = new FormData();
                formData.append('page_id', page_id);
                formData.append('location_id', location_new_id);
                formData.append('category_id', category_new_id);
                formData.append('user_id', selected_new_user);


                let path = base_url + "/admin/addNewUser";
                if (page_id > 0) {
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (response) {
                            $('#exampleModal').modal('hide');
                            if (response.data.id) {

                                swal({
                                    position: 'top-end',
                                    type: "success",
                                    title: ' User has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(function () {
                                    window.location.reload(1);
                                }, 2000);
                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
                }
            });

            $("#location_new_id").change(function () {

                let location_new_id = $("#location_new_id").val();
                console.log(location_new_id)
                $("#selected_new_user").html('');
                let formData = new FormData();
                formData.append('location_id', location_new_id);
                let path = base_url + "/admin/getUsersByLocation";

                if (location_new_id > 0) {

                    $('#selected_new_user').append('<option value="">Chose User</option>');
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (response) {
                            if (response.data) {
                                if (response.data.length > 0) {
                                    for (var ind = 0; ind < response.data.length; ind++) {
                                        let opj = response.data[ind];
                                        let elm = '<option value="' + opj.id + '">' + opj.name + '</option>'
                                        $('#selected_new_user').append(elm);
                                    }
                                }
                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
                }
            });

            $("#location_id").change(function () {

                let location_id = $("#location_id").val();
                console.log(location_id)
                $("#selected_user").html('');
                let formData = new FormData();
                formData.append('location_id', location_id);
                let path = base_url + "/admin/getUsersByLocation";

                if (location_id > 0) {

                    $('#selected_user').append('<option value="">Chose User</option>');
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        success: function (response) {
                            if (response.data) {
                                if (response.data.length > 0) {
                                    for (var ind = 0; ind < response.data.length; ind++) {
                                        let opj = response.data[ind];
                                        let elm = '<option value="' + opj.id + '">' + opj.name + '</option>'
                                        $('#selected_user').append(elm);
                                    }
                                }
                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
                }
            });

        });

        function goToSetValus(id, location_id, category_id, user_id) {
            $("#location_id").val(location_id);
            $("#category_id").val(category_id);
            $("#selected_user").val(user_id);
            edituser = id;
            oldedituser = user_id;
        }

        function deleteConfirmation(id,user_id) {
            let formData = new FormData();
            formData.append('id', id);
            formData.append('user_id', user_id);
            let path = base_url + "/admin/deleteCategoryUser";
            if (id > 0) {
                swal({
                    title: "{{trans('datatable.Delete?')}}",
                    text: "{{trans('datatable.Please ensure and then confirm!')}}",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "{{trans('datatable.Yes, delete it!')}}",
                    cancelButtonText: "{{trans('datatable.No, cancel!')}}",
                    reverseButtons: !0
                }).then(function (e) {

                    if (e.value === true) {

                        $.ajax({
                            url: path,
                            type: 'POST',
                            data: formData,
                            cache: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            processData: false,
                            success: function (results) {
                                $('#exampleModal').modal('hide');
                                if (results.success === true) {
                                    swal("{{trans('datatable.Done!')}}", results.message, "success");
                                    setTimeout(function () {
                                        window.location.reload(1);
                                    }, 2000);
                                } else {
                                    swal("{{trans('datatable.Error!')}}", results.message, "error");
                                }
                            },
                            error: function (response) {
                                console.log(response)
                                alert('error');
                            }
                        });

                    } else {
                        e.dismiss;
                    }

                }, function (dismiss) {
                    return false;
                })
            }
        }
    </script>
@endpush
