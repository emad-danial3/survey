
<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('admin.categoryEdit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('small_title'); ?>
    <?php echo e(trans('admin.categories')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo e(trans('admin.categoryEdit')); ?></h3>
            </div>
            <div class="box-body">
                <div class="box">
                    <?php echo $__env->make('partials.validations_errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="box-body">
                        <?php echo Form::model($model, [
                            'action' => ['Admin\CategoryController@categoryUpdate',$model->id],
                            'method' =>'post',
                            'files' =>true,
                        ]); ?>





                        <div class="form-group">
                            <label for="name"><?php echo e(trans('admin.name')); ?></label>
                            <?php echo Form::text('name', $model->name , ['class' => 'form-control', 'required' => 'required']); ?>

                        </div>

                        <div class="form-group">
                            <label for="status"><?php echo e(trans('admin.status')); ?></label>

                            <select name="status" class="form-control">
                                <option <?php echo e(old('status',$model->status)=="0"? 'selected':''); ?>  value="0">No Active</option>
                                <option <?php echo e(old('status',$model->status)=="1"? 'selected':''); ?> value="1">Active</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="img"><?php echo e(trans('admin.img')); ?></label>
                            <input type="file" class="form-control" name="img">
                            <?php if($model->img != null): ?>
                                <img src="<?php echo e(url($model->img)); ?>" alt="000000" class="img-thumbnail"
                                     width="50px" height="50px">
                            <?php endif; ?>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\emad\survey\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>