<?php $model = app('App\User'); ?>
<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.userCreate')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.users')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('admin.userCreate')); ?></h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">
                        <?php echo Form::model($model, [
                            'action' => ['Admin\UserController@userStore'],
                            'method' =>'post',
                            'files' =>true,
                        ]); ?>



                        <div class="form-group">
                            <label for="name"><?php echo e(trans('admin.name')); ?></label>
                            <?php echo Form::text('name', null , ['class' => 'form-control']); ?>

                        </div>

                        <div class="form-group">
                            <label for="email"><?php echo e(trans('admin.email')); ?></label>
                            <?php echo Form::email('email', null , ['class' => 'form-control']); ?>

                        </div>

                        <div class="form-group">
                            <label for="mobile"><?php echo e(trans('admin.mobile')); ?></label>
                            <?php echo Form::text('mobile', null , ['class' => 'form-control']); ?>

                        </div>

                        <?php $locations = app('App\Models\Locations'); ?>
                        <?php if($locations->where('id','>', 0)->where('status', '1')->count() != 0): ?>
                            <div class="form-group">
                                <label for="location_id"><?php echo e(trans('admin.location_id')); ?> *</label>
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

                        <div class="form-group">
                            <label for="image">Profile <?php echo e(trans('admin.image')); ?></label>
                            <input type="file" class="form-control-file" name="image">
                            <?php if($model->image != null): ?>
                                <img src="<?php echo e(Storage::url($model->image)); ?>" alt="000000" class="img-thumbnail"
                                     width="50px" height="50px">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="gender"><?php echo e(trans('admin.gender')); ?> *</label>
                            <div class="form-control row">
                                <input type="radio" id="gender" name="gender" class="male" checked required
                                       value="male"> <?php echo e(trans('admin.male')); ?>

                                <input type="radio" id="gender" name="gender" class="female" style="<?php if(direction() == 'ltr'): ?> margin-left: 30px; <?php else: ?> margin-right: 30px; <?php endif; ?>" required
                                       value="female"> <?php echo e(trans('admin.female')); ?>

                            </div>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\survey\resources\views/admin/users/create.blade.php ENDPATH**/ ?>