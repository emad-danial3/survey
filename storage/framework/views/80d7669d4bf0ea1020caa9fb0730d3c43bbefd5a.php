<?php $model = app('App\Models\Atr_policy'); ?>
<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.policyCreate')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.policies')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('admin.policyCreate')); ?></h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">
                        <?php echo Form::model($model, [
                            'action' => ['Admin\PolicyController@store'],
                            'method' =>'post',
                            'files' =>true,
                        ]); ?>



                        <?php $departments = app('App\Models\Department'); ?>
                        <?php if($departments->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                            <div class="form-group">
                                <label for="departments_id"><?php echo e(trans('admin.departments_id')); ?> *</label>
                                <select class="form-control select2" id="departments_id" required
                                        name="departments_id">
                                    <option value="0"><?php echo e(trans('admin.departments_id')); ?></option>
                                    <?php $__currentLoopData = $departments->where('id','>', 0)->where('status', '1')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($department->id); ?>">
                                            <?php echo e($department->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php endif; ?>


                        <div class="form-group">
                            <label for="clause">Policy Clause</label>
                            <?php echo Form::text('clause', null , ['class' => 'form-control','required'=>'required' , 'placeholder'=>'Policy Clause']); ?>

                        </div>
                        <div class="form-group">
                            <label for="policy_name">Policy Name</label>
                            <?php echo Form::text('policy_name', null , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Name']); ?>

                        </div>
                        <div class="form-group">
                            <label for="policy_content">Policy Content</label>
                            <?php echo Form::text('policy_content', null , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Content']); ?>

                        </div>
                        <div class="form-group">
                            <label for="policy_page">Policy Page</label>
                            <?php echo Form::text('policy_page', null , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Page']); ?>

                        </div>
                        <div class="form-group">
                            <label for="policy_path">Policy Path</label>
                            <?php echo Form::text('policy_path', null , ['class' => 'form-control','required'=>'required', 'placeholder'=>'Policy Path']); ?>

                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.submit')); ?></button>
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
            $('.select2').select2();

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/oso/Desktop/survey/resources/views/admin/policies/create.blade.php ENDPATH**/ ?>