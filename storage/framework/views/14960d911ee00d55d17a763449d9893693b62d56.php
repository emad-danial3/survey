<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.pageEdit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.pages')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('admin.pageEdit')); ?></h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">
                        <?php echo Form::model($model, [
                            'action' => ['Admin\PageController@pageUpdate',$model->id],
                            'method' =>'post',
                            'files' =>true,
                        ]); ?>


                        <input id="page_id" value="<?php echo e($model->id); ?>"  type="hidden">
                        <div class="form-group col-md-6">
                            <label for="name"><?php echo e(trans('admin.name')); ?></label>
                            <?php echo Form::text('name', $model->name , ['class' => 'form-control', 'required' => 'required','id'=>'main_page_title']); ?>

                        </div>

                        <div class="form-group col-md-3">
                            <label for="date"><?php echo e(trans('admin.from_date')); ?></label>
                            <?php echo Form::date('date', $model->from_date , ['class' => 'form-control', 'required' => 'required','id'=>'date']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="to_date"><?php echo e(trans('admin.to_date')); ?></label>
                            <?php echo Form::date('to_date', $model->to_date , ['class' => 'form-control', 'required' => 'required','id'=>'to_date']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_1_percent">Option <?php echo e($question_options['option_1']); ?>  percent (%)</label>
                            <?php echo Form::number('option_1_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_1_percent']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_2_percent">Option <?php echo e($question_options['option_2']); ?> percent (%)</label>
                            <?php echo Form::number('option_2_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_2_percent']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_3_percent"> Option <?php echo e($question_options['option_3']); ?> percent (%)</label>
                            <?php echo Form::number('option_3_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_3_percent']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_4_percent"> Option <?php echo e($question_options['option_4']); ?> percent (%)</label>
                            <?php echo Form::number('option_4_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_4_percent']); ?>

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

                            <?php if($page_question): ?>
                                <?php $__currentLoopData = $page_question; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($key+1); ?></th>
                                        <td><?php echo e($question['location']['name']); ?></td>
                                        <td><?php echo e($question['category']['name']); ?></td>
                                        <td>
                                                    <?php if($question['users']): ?>
                                                        <?php $__currentLoopData = $question['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <p>   <?php echo e($user['user']['name']); ?> </p>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button type="button" class="btn btn-primary " data-toggle="modal"
                                                                            onclick="goToSetValus(<?php echo e($question['id']); ?>,<?php echo e($question['location_id']); ?>,<?php echo e($question['category_id']); ?>,<?php echo e($user['user']['id']); ?>)"
                                                                            data-target="#exampleModal">Edit
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button type="button" class="btn btn-danger"
                                                                            onclick="deleteConfirmation(<?php echo e($question['id']); ?>,<?php echo e($user['user']['id']); ?>)">Delete
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-10">
<br>
                            </div>



                        </div>



                        <div class="row">
                            <div class="col-md-12">



                                <div class="form-group col-md-12" id="questions_container_body">
                                    <div  id="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>
                                                    <label>Add Locations Categories</label>
                                                </h4>
                                            </div>
                                            <div class="col-md-6 ">
                                                <?php $locations = app('App\Models\Locations'); ?>
                                                <?php if($locations->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                                                    <div class="form-group">
                                                        <h4>
                                                            <label for="location_id"><?php echo e(trans('admin.location_id')); ?> *</label>
                                                        </h4>

                                                        <select class="form-control select2" id="location_id" required
                                                                name="location_id">
                                                            <option value="0"><?php echo e(trans('admin.location_id')); ?></option>
                                                            <?php $__currentLoopData = $locations->where('id','>', 0)->where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option
                                                                    value="<?php echo e($location->id); ?>">
                                                                    <td><?php echo e($location->name); ?></td>
                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-6 ">
                                                <?php $categories = app('App\Models\Category'); ?>
                                                <?php if($categories->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                                                    <div class="form-group">
                                                        <h4>
                                                            <label for="category_id"><?php echo e(trans('admin.category_id')); ?> *</label>
                                                        </h4>

                                                        <select class="form-control select2" id="category_id" required
                                                                name="category_id">
                                                            <option value="0"><?php echo e(trans('admin.category_id')); ?></option>
                                                            <?php $__currentLoopData = $categories->where('id','>', 0)->where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option
                                                                    value="<?php echo e($category->id); ?>">
                                                                    <?php echo e($category->name); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-md-12 row" id="questions_users_container">
                                                <div class="col-md-12">
                                                    <h4>
                                                        <label>Users</label>
                                                    </h4>
                                                    <div id="questions_users_store" class="row">

                                                    </div>
                                                </div>


                                                <div class=" col-md-6">

                                                    <?php $users = app('App\User'); ?>
                                                    <?php if($users->where('id','>', 0)->where('status', 'active')->where('user_type', 'worker')->count() != 0): ?>
                                                        <div class="form-group col-md-12">
                                                            <label for="user_id">Chose <?php echo e(trans('admin.user_id')); ?> </label>
                                                            <div class="row" style="display: flex">
                                                                <div class="col-md-10">
                                                                    <select class="form-control " id="selected_user" required
                                                                            name="users">
                                                                        <option value="">Chose User</option>
                                                                        <?php $__currentLoopData = $users->where('id','>', 0)->where('status', 'active')->where('user_type', 'worker') ->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option
                                                                                value="<?php echo e($user->id); ?>">
                                                                                <?php echo e($user->name); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <a class="btn btn-info " id="add_uesr" > +  <i class="fa fa-user"></i>  Add  </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <a class="btn btn-info" id="add_question" > +  Add Location</a>
                                    </div>
                                    <br>
                                </div>




                            </div>

                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"> Finish & <?php echo e(trans('admin.submit')); ?></button>
                        </div>

                        <?php echo Form::close(); ?>

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
                                <?php $locations = app('App\Models\Locations'); ?>
                                <?php if($locations->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="location_id"><?php echo e(trans('admin.location_id')); ?> *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control  col-md-12" id="location_id" required
                                                    name="location_id">
                                                <option value="0"><?php echo e(trans('admin.location_id')); ?></option>
                                                <?php $__currentLoopData = $locations->where('id','>', 0)->where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        value="<?php echo e($location->id); ?>">
                                                        <td><?php echo e($location->name); ?></td>
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 ">
                                <?php $categories = app('App\Models\Category'); ?>
                                <?php if($categories->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <label for="category_id"><?php echo e(trans('admin.category_id')); ?> *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control  " id="category_id" required
                                                    name="category_id">
                                                <option value="0"><?php echo e(trans('admin.category_id')); ?></option>
                                                <?php $__currentLoopData = $categories->where('id','>', 0)->where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        value="<?php echo e($category->id); ?>">
                                                        <?php echo e($category->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>


                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <?php $users = app('App\User'); ?>
                                <?php if($users->where('id','>', 0)->where('status', 'active')->count() != 0): ?>
                                    <div class="form-group ">
                                        <label for="user_id">Chose <?php echo e(trans('admin.user_id')); ?> </label>

                                        <select class="form-control " id="selected_user" required
                                                name="users">
                                            <option value="">Chose User</option>
                                            <?php $__currentLoopData = $users->where('id','>', 0)->where('status', 'active')->where('user_type', 'worker') ->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($user->id); ?>">
                                                    <?php echo e($user->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
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
                                <?php $locations = app('App\Models\Locations'); ?>
                                <?php if($locations->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="location_new_id"><?php echo e(trans('admin.location_id')); ?> *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control  col-md-12" id="location_new_id" required
                                                    name="location_new_id">
                                                <option value="0"><?php echo e(trans('admin.location_id')); ?></option>
                                                <?php $__currentLoopData = $locations->where('id','>', 0)->where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        value="<?php echo e($location->id); ?>">
                                                        <td><?php echo e($location->name); ?></td>
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 ">
                                <?php $categories = app('App\Models\Category'); ?>
                                <?php if($categories->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <label for="category_new_id"><?php echo e(trans('admin.category_id')); ?> *</label>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-control  " id="category_new_id" required
                                                    name="category_new_id">
                                                <option value="0"><?php echo e(trans('admin.category_id')); ?></option>
                                                <?php $__currentLoopData = $categories->where('id','>', 0)->where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        value="<?php echo e($category->id); ?>">
                                                        <?php echo e($category->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>


                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6">
                                <?php $users = app('App\User'); ?>
                                <?php if($users->where('id','>', 0)->where('status', 'active')->count() != 0): ?>
                                    <div class="form-group ">
                                        <label for="user_id">Chose <?php echo e(trans('admin.user_id')); ?> </label>

                                        <select class="form-control " id="selected_new_user" required
                                                name="users">
                                            <option value="">Chose User</option>
                                            <?php $__currentLoopData = $users->where('id','>', 0)->where('status', 'active')->where('user_type', 'worker') ->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($user->id); ?>">
                                                    <?php echo e($user->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>

        var question_users=[];
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

            $("#add_uesr").click(function (){
                var newuser=  $("#selected_user").val();
                var newusernem=$("#selected_user option:selected").text();
                var checkuser= question_users.includes(newuser);
                if(newuser > 0 && checkuser ==false){
                    question_users.push(newuser);

                    $("#questions_users_store").append(
                        '<div class="col-md-3" style="background: #eee;padding: 5px;border: 1px solid #ddd;border-radius: 5px; "> <label > '+newusernem+' </label>'+' <\div> \n'
                    );
                    $("#selected_user").val('');
                }
            });

            $("#add_question").click(function (){

                let page_id = $("#page_id").val();
                let main_page_title= $("#main_page_title").val();
                let main_page_date= $("#date").val();
                let main_page_to_date= $("#to_date").val();
                let main_page_option_1_percent= $("#option_1_percent").val();
                let main_page_option_2_percent= $("#option_2_percent").val();
                let main_page_option_3_percent= $("#option_3_percent").val();
                let main_page_option_4_percent= $("#option_4_percent").val();
                let location_id = $("#location_id").val();
                let category_id = $("#category_id").val();

                var location_name=$("#location_id option:selected").text();
                var cat_name=$("#category_id option:selected").text();
                let formData = new FormData();
                formData.append('page_id', page_id);
                formData.append('main_page_title',main_page_title);
                formData.append('main_page_date',main_page_date);
                formData.append('main_page_to_date',main_page_to_date);
                formData.append('main_page_option_1_percent',main_page_option_1_percent);
                formData.append('main_page_option_2_percent',main_page_option_2_percent);
                formData.append('main_page_option_3_percent',main_page_option_3_percent);
                formData.append('main_page_option_4_percent',main_page_option_4_percent);
                formData.append('location_id',location_id);
                formData.append('category_id',category_id);
                formData.append('question_users',  JSON.stringify(question_users));

                let path = base_url+"/admin/addNewQuestion";

                if((question_users.length ==0 )){
                    swal({
                        title: 'Oops...',
                        text: 'Should Choice User',
                        type: "warning",
                    })
                }else {
                    //   page_id == '' main this add page first time
                    if(page_id==''){

                    }else {
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
                                if(response.data.id){

                                    page_id=response.data.id;
                                    $( "#main_page_title" ).prop( "disabled", true );
                                    $( "#date" ).prop( "disabled", true );
                                    $("#questions_users_store").text('');



                                    $('#location_id option[value=""]').attr('selected','selected');
                                    $('#category_id option[value=""]').attr('selected','selected');
                                    swal({
                                        position: 'top-end',
                                        type: "success",
                                        title: 'Your Question has been saved',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    question_users=[];

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
                }


            });




            $("#questions_container_body").css('border','1px solid #e7e7e7');
            $("#questions_container_body").css('border-radius','5px');
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
                    title: "<?php echo e(trans('datatable.Delete?')); ?>",
                    text: "<?php echo e(trans('datatable.Please ensure and then confirm!')); ?>",
                    type: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "<?php echo e(trans('datatable.Yes, delete it!')); ?>",
                    cancelButtonText: "<?php echo e(trans('datatable.No, cancel!')); ?>",
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
                                    swal("<?php echo e(trans('datatable.Done!')); ?>", results.message, "success");
                                    setTimeout(function () {
                                        window.location.reload(1);
                                    }, 2000);
                                } else {
                                    swal("<?php echo e(trans('datatable.Error!')); ?>", results.message, "error");
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\survey\resources\views/admin/pages/edit.blade.php ENDPATH**/ ?>