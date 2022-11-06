
<?php $model = app('App\Models\Page'); ?>
<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.pageCreate')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.pages')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('admin.pageCreate')); ?></h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">
                        <?php echo Form::model($model, [
                            'action' => ['Admin\PageController@pageStore'],
                            'method' =>'post',
                            'files' =>true,
                        ]); ?>


                        <div class="form-group col-md-6">
                            <label for="name"><?php echo e(trans('admin.name')); ?></label>
                            <?php echo Form::text('name', null , ['class' => 'form-control', 'required' => 'required','id'=>'main_page_title']); ?>

                        </div>

                        <div class="form-group col-md-3">
                            <label for="date"><?php echo e(trans('admin.from_date')); ?></label>
                            <?php echo Form::date('date', null , ['class' => 'form-control', 'required' => 'required','id'=>'date']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="to_date"><?php echo e(trans('admin.to_date')); ?></label>
                            <?php echo Form::date('to_date', null , ['class' => 'form-control', 'required' => 'required','id'=>'to_date']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_1_percent">Pption 1 percent (%)</label>
                            <?php echo Form::number('option_1_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_1_percent']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_2_percent">Pption 2 percent (%)</label>
                            <?php echo Form::number('option_2_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_2_percent']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_3_percent">Pption 3 percent (%)</label>
                            <?php echo Form::number('option_3_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_3_percent']); ?>

                        </div>
                        <div class="form-group col-md-3">
                            <label for="option_4_percent">Pption 4 percent (%)</label>
                            <?php echo Form::number('option_4_percent', null , ['class' => 'form-control', 'required' => 'required','id'=>'option_4_percent']); ?>

                        </div>

<br>
                        <div class="col-md-12" id="LocationsCategories">
                            <h4>
                                <label>Saved Locations Categories</label>
                            </h4>
                            <div id="LocationsCategoriesStore" class="row">

                            </div>
                            <br>
                        </div>


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
                                              <?php if($users->where('id','>', 0)->where('status', 'active')->count() != 0): ?>
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



                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Finish & <?php echo e(trans('admin.submit')); ?> </button>
                        </div>

                        <?php echo Form::close(); ?>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <script>
        $(document).ready(function () {
            var page_id='';
            var question_users=[];
            var base_url = window.location.origin;

            $('.select2').select2();
            $('#LocationsCategories').hide();

            $("#location_id").change(function (){

                let location_id = $("#location_id").val();
                let formData = new FormData();
                    formData.append('location_id',location_id);
                let path = base_url+"/admin/getUsersByLocation";

                if((location_id > 0 )){
                    $("#selected_user").html('');
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
                            if(response.data){
                                if(response.data.length >0){
                                    for (var ind=0;ind <response.data.length ;ind++){
                                        let opj=response.data[ind];
                                        let elm='<option value="'+opj.id+'">'+opj.name+'</option>'
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

            $("#add_question").click(function (){

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

                if((question_users.length ==0 ) || (page_id == '' && main_page_title=='') ){
                    if((page_id == '' && main_page_title=='')){
                        swal({
                            title: 'Oops...',
                            text: 'Should Enter Page Name',
                            type: "warning",
                        })
                    }else {
                        swal({

                            title: 'Oops...',
                            text: 'Should Choice User',
                            type: "warning",
                        })
                    }
                }else {
                //   page_id == '' main this add page first time
                if(page_id==''){
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
                                $( "#to_date" ).prop( "disabled", true );
                                $( "#option_1_percent" ).prop( "disabled", true );
                                $( "#option_2_percent" ).prop( "disabled", true );
                                $( "#option_3_percent" ).prop( "disabled", true );
                                $( "#option_4_percent" ).prop( "disabled", true );
                                $("#questions_users_store").text('');

                                $('#LocationsCategories').show();
                                $("#LocationsCategoriesStore").append(
                                    '<div class="col-md-4" style="background: #eee;padding: 5px;border: 1px solid #ddd;border-radius: 5px; "> <label > '+location_name+ ' - '+cat_name+' </label>'+' <\div> \n'
                                );

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

                            }
                        },
                        error: function (response) {
                            console.log(response)
                            alert('error');
                        }
                    });
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

                                $('#LocationsCategories').show();
                                $("#LocationsCategoriesStore").append(
                                    '<div class="col-md-4" style="background: #eee;padding: 5px;border: 1px solid #ddd;border-radius: 5px; "> <label > '+location_name+ ' - '+cat_name+' </label>'+' <\div> \n'
                                );

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

            $("#questions_container_body").css('border','1px solid #e7e7e7');
            $("#questions_container_body").css('border-radius','5px');
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\eva\survey\resources\views/admin/pages/create.blade.php ENDPATH**/ ?>